package tj.zar.projects.imagehostingservice.app.view;

import tj.zar.java.patterns.common.Command;
import tj.zar.projects.imagehostingservice.R;
import tj.zar.projects.imagehostingservice.app.activity.HomeActivity;
import tj.zar.projects.imagehostingservice.app.model.vo.ImageVo;
import tj.zar.projects.imagehostingservice.app.view.adapter.ImagesAdapter;
import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AbsSpinner;
import android.widget.EditText;
import android.widget.Toast;

/**
 * Mediator implementation between {@link HomeActivity} layout view and
 * {@link HomeActivity}. Controls all view operations of the
 * {@link HomeActivity}.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public class HomeActivityViewMediatorImpl implements HomeActivityViewMediator {

	// -----------------------------------------------
	// Private fields
	// -----------------------------------------------
	
	/**
	 * Activity used by this mediator. 
	 */
	private Activity activity;
	
	/**
	 * Represents gird with user's favorite images.
	 */
	private AbsSpinner favoriteImagesList;
	
	/**
	 * Represents gird with random generated images.
	 */
	private AbsSpinner randomImagesList;
	
	/**
	 * Button stands to generate new images from the flikr service.
	 */
	private View generateFlikrButton;
	
	/**
	 * Button stands to generate new images from the instagram service.
	 */
	private View generateInstagramButton;

	/**
	 * Represents random images.
	 */
	private ImagesAdapter randomImagesAdapter;

	/**
	 * Represents favorite images.
	 */
	private ImagesAdapter favoriteImagesAdapter;

	/**
	 * Button listens to add description to the image event.
	 */
	private View addDescriptionButton;

	/**
	 * Button listens to add image to favorite list event.
	 */
	private View addFavoriteButton;

	/**
	 * Button listens to remove from favorite list event.
	 */
	private View removeFavoriteButton;

	// -----------------------------------------------
	// Constructors
	// -----------------------------------------------

	/**
	 * 
	 * @param activity
	 *            - {@link Activity} used by mediator.
	 */
	public HomeActivityViewMediatorImpl(final Activity activity) {
		this.activity = activity;
		initContentView();
		loadViews();
		setupViews();
	}

	// -----------------------------------------------
	// Overridden methods (from HomeActivityViewMediator)
	// -----------------------------------------------

	@Override
	public void setGenerateFlikrCommand(final Command command) {
		generateFlikrButton.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				if (command != null)
					command.execute(null);
			}
		});
	}

	@Override
	public void setGenerateInstagramCommand(final Command command) {
		generateInstagramButton.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				if (command != null)
					command.execute(null);
			}
		});
	}

	@Override
	public void fillFavoriteImages(final ImageVo[] images) {
		favoriteImagesAdapter.setImages(images);
		favoriteImagesAdapter.notifyDataSetChanged();
	}

	@Override
	public void fillRandomImages(final ImageVo[] images) {
		randomImagesAdapter.setImages(images);
		randomImagesAdapter.notifyDataSetChanged();
	}
	
	@Override
	public void setAddFavoriteCommand(final Command command) {
		addFavoriteButton.setOnClickListener(new SetFavoriteClickListener(command));
	}
	
	@Override
	public void setRemoveFavoriteCommand(final Command command) {
		removeFavoriteButton.setOnClickListener(new RemoveFromFavoriteClickListener(command));
	}
	
	@Override
	public void setAddDescriptionCommand(final Command command) {
		addDescriptionButton.setOnClickListener(new AddDescriptionClickListener(command));
	}
	
	@Override
	public void showMessage(final String message) {
		Toast.makeText(activity, message, Toast.LENGTH_SHORT).show();
	}

	// -----------------------------------------------
	// Private methods
	// -----------------------------------------------

	/**
	 * Shows add description form to used and executes command. Sends to command
	 * the source image with new description.
	 * 
	 * @param command
	 *            - command to be executed when adding done
	 * @param image
	 *            - image which description will be updated
	 */
	private void showAddDescriptionForm(final Command command, final ImageVo image) {

		final EditText descritionText = new EditText(activity);
		descritionText.setText(image.getDescription());
		
		new AlertDialog.Builder(activity)
			.setTitle(R.string.add_description)
			.setMessage(R.string.add_image_description)
			.setView(descritionText)
			.setPositiveButton(android.R.string.ok, new DialogInterface.OnClickListener() {
	
				@Override
				public void onClick(DialogInterface dialog, int whichButton) {
					image.setDescription(descritionText.getText().toString());
					command.execute(image);
					favoriteImagesAdapter.notifyDataSetChanged();
			
					Toast.makeText(activity, R.string.description_has_been_added, Toast.LENGTH_SHORT)
							.show();
				}
			})
			.show();
	}
	
	/**
	 * Sets the content view of the {@link #activity} instance.
	 */
	private void initContentView() {
		activity.setContentView(R.layout.activity_home);
	}
	
	/**
	 * Loads all views of the layout inside {@link #activity}'s content view.
	 */
	private void loadViews() {
		favoriteImagesList		= (AbsSpinner)	activity.findViewById(R.id.favoriteImagesGrid);
		randomImagesList		= (AbsSpinner)	activity.findViewById(R.id.randomImagesGrid);
		generateFlikrButton		= activity.findViewById(R.id.generateFlikrButton);
		generateInstagramButton	= activity.findViewById(R.id.generateInstagramButton);

		addDescriptionButton	= activity.findViewById(R.id.addDescriptionButton);
		addFavoriteButton		= activity.findViewById(R.id.addFavoriteButton);
		removeFavoriteButton	= activity.findViewById(R.id.removeFavoriteButton);
	}
	
	/**
	 * Setups views and it components.
	 */
	private void setupViews() {
		randomImagesAdapter		= new ImagesAdapter(activity, R.layout.adapter_random_image);
		favoriteImagesAdapter	= new ImagesAdapter(activity, R.layout.adapter_favorite_image);

		favoriteImagesList.setAdapter(favoriteImagesAdapter);
		randomImagesList.setAdapter(randomImagesAdapter);
	}
	
	// ----------------------------------------------------------------------
	// Inner classes
	// ----------------------------------------------------------------------

	/**
	 * Listens to click event and removes image from favorite list when click
	 * performed.
	 */
	private class RemoveFromFavoriteClickListener implements OnClickListener {
		
		// private fields
		private Command command;

		// constructor
		protected RemoveFromFavoriteClickListener(final Command command) {
			this.command = command;
		}
		
		// overridden methods
		@Override
		public void onClick(View v) {
			Object selectedItem = favoriteImagesList.getSelectedItem();
			if (selectedItem != null && selectedItem instanceof ImageVo) {
				command.execute((ImageVo) selectedItem);
				favoriteImagesAdapter.removeImage(favoriteImagesList.getSelectedItemPosition());
				favoriteImagesAdapter.notifyDataSetChanged();
				Toast.makeText(activity, R.string.image_has_been_removed_from_favorite_list, Toast.LENGTH_SHORT).show();
			} else {
				Toast.makeText(activity, R.string.no_images_to_remove, Toast.LENGTH_SHORT).show();
			}
		}
	}

	/**
	 * Listens to click event and adds description to the image when click
	 * performed.
	 */
	private class AddDescriptionClickListener implements OnClickListener {
		
		// private fields
		private Command command;

		// constructor
		protected AddDescriptionClickListener(final Command command) {
			this.command = command;
		}
		
		// overridden methods
		@Override
		public void onClick(View v) {
			Object selectedItem = favoriteImagesList.getSelectedItem();
			if (selectedItem != null && selectedItem instanceof ImageVo) {
				showAddDescriptionForm(command, (ImageVo) selectedItem);
			} else {
				Toast.makeText(activity, R.string.no_images_to_add_description, Toast.LENGTH_SHORT).show();
			}
		}
	}

	/**
	 * Listens to click event and sets image as a favorite image when click
	 * performed.
	 */
	private class SetFavoriteClickListener implements OnClickListener {
		
		// private fields
		private Command command;

		// constructor
		protected SetFavoriteClickListener(final Command command) {
			this.command = command;
		}
		
		// overridden methods
		@Override
		public void onClick(View v) {
			Object selectedItem = randomImagesList.getSelectedItem();
			if (selectedItem != null && selectedItem instanceof ImageVo) {
				ImageVo image = (ImageVo) selectedItem;
				command.execute(image);
				favoriteImagesAdapter.addImage(image);
				randomImagesAdapter.removeImage(randomImagesList.getSelectedItemPosition());
				Toast.makeText(activity, R.string.image_set_as_a_favorite, Toast.LENGTH_SHORT).show();
			} else {
				Toast.makeText(activity, R.string.nothing_to_set_as_favorite, Toast.LENGTH_LONG).show();
			}
		}
	}

}
