package tj.zar.projects.imagehostingservice.app.model;

import android.content.Context;
import tj.zar.java.patterns.common.Command;
import tj.zar.projects.imagehostingservice.api.server.ZarImageHostingServer;
import tj.zar.projects.imagehostingservice.api.service.Image;
import tj.zar.projects.imagehostingservice.api.service.ImageHostingService;
import tj.zar.projects.imagehostingservice.api.service.ImageHostingServiceImpl;
import tj.zar.projects.imagehostingservice.api.service.ImageReceiveListener;
import tj.zar.projects.imagehostingservice.app.model.vo.ImageVo;

/**
 * Provides Proxy to the ImageHostingService components. Controllers and Views
 * work only with proxies, so they doesn't know how proxies really work.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public class ImageHostingServiceProxyImpl implements ImageHostingServiceProxy  {

	// -----------------------------------------------
	// Private fields
	// -----------------------------------------------

	/**
	 * Image Hosting service used to work with remote image data.
	 */
	private ImageHostingService imageService;

	// -----------------------------------------------
	// Constructors
	// -----------------------------------------------

	/**
	 * 
	 * @param context
	 *            - {@link Context} used by application
	 */
	public ImageHostingServiceProxyImpl(Context context) {
		imageService = new ImageHostingServiceImpl(context, new ZarImageHostingServer());
	}

	// -----------------------------------------------
	// Overridden methods (from ImageHostingServiceProxy)
	// -----------------------------------------------

	@Override
	public void obtainImages(final Command successCommand, final Command errorCommand) {
		imageService.obtainImages(new ImageReceiveListener() {
			
			@Override
			public void onReceive(Image[] images) {
				if (successCommand != null)
					successCommand.execute(convertImageArrayVoArray(images));
			}
			
			@Override
			public void onError(String error) {
				if (errorCommand != null)
					errorCommand.execute(error);
			}
		});
	}

	@Override
	public void obtainFavoriteImages(final Command successCommand, final Command errorCommand) {
		imageService.obtainFavoriteImages(new ImageReceiveListener() {
			
			@Override
			public void onReceive(Image[] images) {
				if (successCommand != null)
					successCommand.execute(convertImageArrayVoArray(images));
			}
			
			@Override
			public void onError(String error) {
				if (errorCommand != null)
					errorCommand.execute(error);
			}
		});
	}

	@Override
	public void generateFlikrImages(final Command successCommand, final Command errorCommand) {
		imageService.generateFlikrImages(new ImageReceiveListener() {
			
			@Override
			public void onReceive(Image[] images) {
				if (successCommand != null)
					successCommand.execute(convertImageArrayVoArray(images));
			}
			
			@Override
			public void onError(String error) {
				if (errorCommand != null)
					errorCommand.execute(error);
			}
		});
	}

	@Override
	public void generateInstagramImages(final Command successCommand, final Command errorCommand) {
		imageService.generateInstagramImages(new ImageReceiveListener() {
			
			@Override
			public void onReceive(Image[] images) {
				if (successCommand != null)
					successCommand.execute(convertImageArrayVoArray(images));
			}
			
			@Override
			public void onError(String error) {
				if (errorCommand != null)
					errorCommand.execute(error);
			}
		});
	}

	@Override
	public void setFavorite(final ImageVo imageVo) {
		imageService.setFavorite(convertImageVoToImage(imageVo));
	}

	@Override
	public void removeFavorite(final ImageVo imageVo) {
		imageService.removeFavorite(convertImageVoToImage(imageVo));
	}

	@Override
	public void setDescription(final ImageVo imageVo) {
		imageService.setDescription(convertImageVoToImage(imageVo));
	}

	// -----------------------------------------------
	// Private methods
	// -----------------------------------------------

	/**
	 * Converts {@link ImageVo} object to the {@link Image} object.
	 * 
	 * @param imageVo
	 *            - {@link ImageVo} object to be converted
	 * @return {@link Image} with {@link ImageVo}'s data
	 */
	private Image convertImageVoToImage(final ImageVo imageVo) {
		return new Image(imageVo.getId(), imageVo.getUrl(), imageVo.getName(),
				imageVo.getDescription());
	}

	/**
	 * Converts {@link Image} array to the {@link ImageVo} array.
	 * 
	 * @param images
	 *            - {@link ImageVo} array to be converted
	 * @return {@link Image} array with {@link ImageVo} array's data
	 */
	private ImageVo[] convertImageArrayVoArray(final Image[] images) {
		if (images == null)
			return null;
		
		ImageVo[] voArray = new ImageVo[images.length];
		for (int i = 0; i < images.length; i++) {
			voArray[i] = new ImageVo(images[i]);
		}
		return voArray;
	}
	
}
