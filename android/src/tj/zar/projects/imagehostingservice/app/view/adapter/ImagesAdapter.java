package tj.zar.projects.imagehostingservice.app.view.adapter;

import java.io.ByteArrayOutputStream;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

import tj.zar.android.util.http.IPostRequestListener;
import tj.zar.android.util.http.PostRequest;
import tj.zar.java.patterns.common.Command;
import tj.zar.projects.imagehostingservice.R;
import tj.zar.projects.imagehostingservice.app.model.vo.ImageVo;
import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.text.TextUtils;
import android.util.SparseArray;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

/**
 * List adapter used to show images.
 * 
 * @param command
 *            - {@link Command} to be executed when "generate flikr images"
 *            button clicked
 */
public class ImagesAdapter extends BaseAdapter  {
	
	// ----------------------------------------------------------------------
	// Private fields
	// ----------------------------------------------------------------------
	
	/**
	 * Application's context.
	 */
	private Context context;
	
	/**
	 * Layout used to represent view of image items.
	 */
	private int layout;
	
	/**
	 * Images used to generate adapter's views.
	 */
	private List<ImageVo> images;
	
	/**
	 * Cache for image views.
	 */
	private SparseArray<Bitmap> imageBitmapCache;
	
	// ----------------------------------------------------------------------
	// Constructors
	// ----------------------------------------------------------------------

	/**
	 * 
	 * @param context
	 *            - {@link Context} used by application
	 * @param layout
	 *            - layout used to represent view of image items
	 */
	public ImagesAdapter(final Context context, final int layout) {
		this.context	= context;
		this.layout		= layout;
		imageBitmapCache = new SparseArray<Bitmap>();
	}
	
	// ----------------------------------------------------------------------
	// Public methods
	// ----------------------------------------------------------------------

	/**
	 * Sets images to the adapter.
	 * 
	 * @param images
	 *            - images shown in the adapter.
	 */
	public void setImages(final ImageVo[] images) {
		this.images = new ArrayList<ImageVo>(Arrays.asList(images));
		imageBitmapCache.clear();
		notifyDataSetInvalidated();
	}

	/**
	 * Removes Image from the adapter at given position.
	 * 
	 * @param position
	 *            - position of the image
	 */
	public void removeImage(final int position) {
		images.remove(position);
		imageBitmapCache.clear();
		notifyDataSetChanged();
	}

	/**
	 * Adds image to the adapter.
	 * 
	 * @param image
	 *            - image to be added
	 */
	public void addImage(ImageVo image) {
		if (images == null)
			images = new ArrayList<ImageVo>();
		
		images.add(image);
		notifyDataSetChanged();
	}
	
	// ----------------------------------------------------------------------
	// Overridden methods (from BaseAdapter)
	// ----------------------------------------------------------------------

	@Override
	public int getCount() {
		if (images == null)
			return 0;
		
		return images.size();
	}

	@Override
	public ImageVo getItem(int position) {
		return images.get(position);
	}

	@Override
	public long getItemId(int position) {
		return position;
	}

	@Override
	public View getView(int position, View convertView, ViewGroup parent) {

		if (convertView == null)
			convertView = LayoutInflater.from(context).inflate(layout, parent, false);
		
		final ImageVo image = getItem(position);
		
		// find the views
		final ImageView imageView 		= (ImageView) 	convertView.findViewById(R.id.image);
		final TextView descriptionText	= (TextView) 	convertView.findViewById(R.id.descriptionText);
		
		// update image in the view
		if (imageView != null && image.getUrl() != null)
			loadImageBitmap(image.getUrl(), position, imageView);
		
		// update description in the view
		String description = image.getDescription();
		if (descriptionText != null && !TextUtils.isEmpty(description)) {
			descriptionText.setVisibility(View.VISIBLE);
			descriptionText.setText(description);
		}
		
		return convertView;
	}
	
	// ----------------------------------------------------------------------
	// Private methods
	// ----------------------------------------------------------------------

	/**
	 * Loads remote image by given url.
	 * 
	 * @param url
	 *            - url of the image
	 * @param position
	 *            - position of the image in the adapter
	 * @param imageView
	 *            - {@link ImageView} that will load remote image
	 */
	private void loadImageBitmap(final String url, final int position, final ImageView imageView) {
		
		// get bitmap from cache if loaded already
		if (imageBitmapCache.get(position) != null) {
			imageView.setImageBitmap(imageBitmapCache.get(position));
			return;
		}

		// cache bitmap if not loaded yet
		new PostRequest(url, null, new IPostRequestListener() {
			
			@Override
			public void onLoading(long loaded, int total) {
			}
			
			@Override
			public void onError(Exception error) {
			}
			
			@Override
			public void onComplete(ByteArrayOutputStream output) {
				byte[] data = output.toByteArray();
				Bitmap bitmap = BitmapFactory.decodeByteArray(data, 0, data.length);
				imageBitmapCache.put(position, bitmap);
				imageView.setImageBitmap(bitmap);
			}
		}).run();
	}

}
