package tj.zar.projects.imagehostingservice.api.service;

import java.util.UUID;

import android.content.Context;
import android.telephony.TelephonyManager;
import tj.zar.android.util.http.PostRequest;
import tj.zar.projects.imagehostingservice.api.server.ImageHostingServer;

/**
 * Base implementation to access Image Hosting Server on the remote server.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public class ImageHostingServiceImpl implements ImageHostingService {

	// -----------------------------------------------
	// Private fields
	// -----------------------------------------------

	/**
	 * Application's context.
	 */
	private Context context;
	
	/**
	 * Image Hosting Server data used to perform requests.
	 */
	private ImageHostingServer server;

	// -----------------------------------------------
	// Constructor
	// -----------------------------------------------

	/**
	 * 
	 * @param context
	 *            - application's context
	 * @param server
	 *            - Image Hosting Server data used to perform requests
	 */
	public ImageHostingServiceImpl(Context context, ImageHostingServer server) {
		this.context	= context;
		this.server		= server;
	}

	// -----------------------------------------------
	// Overridden methods (from ImageHostingService)
	// -----------------------------------------------
	
	@Override
	public void obtainImages(ImageReceiveListener listener) {
		final PostRequest request = new PostRequest(server.getImagesUrl(), null,
													new ImagesRequestListener(listener));
		request.setCookies("user=" + getDeviceId());
		request.run();
	}

	@Override
	public void obtainFavoriteImages(ImageReceiveListener listener) {
		final PostRequest request = new PostRequest(server.getFavoriteImagesUrl(), null,
													new ImagesRequestListener(listener));
		request.setCookies("user=" + getDeviceId());
		request.run();
	}

	@Override
	public void generateFlikrImages(ImageReceiveListener listener) {
		final PostRequest request = new PostRequest(server.generateFlikrImagesUrl(), null,
				new ImagesRequestListener(listener));
		request.setCookies("user=" + getDeviceId());
		request.run();
	}

	@Override
	public void generateInstagramImages(ImageReceiveListener listener) {
		final PostRequest request = new PostRequest(server.generateInstagramImagesUrl(), null,
				new ImagesRequestListener(listener));
		request.setCookies("user=" + getDeviceId());
		request.run();
	}

	@Override
	public void setFavorite(Image image) {
		final PostRequest request = new PostRequest(server.addFavoriteImageUrl(image.getId()), null);
		request.setCookies("user=" + getDeviceId());
		request.run();
	}

	@Override
	public void removeFavorite(Image image) {
		final PostRequest request = new PostRequest(server.removeFavoriteImageUrl(image.getId()), null);
		request.setCookies("user=" + getDeviceId());
		request.run();
	}

	@Override
	public void setDescription(Image image) {
		final PostRequest request = new PostRequest(server.addDescriptionUrl(image.getId()),
						"text=" + image.getDescription());
		request.setCookies("user=" + getDeviceId());
		request.run();
	}

	// -----------------------------------------------
	// Private methods
	// -----------------------------------------------

	/**
	 * Returns current device unique id. This id can be used as unique user id.
	 * 
	 * @return unique device id
	 */
	private String getDeviceId() {
		final TelephonyManager tm = (TelephonyManager) context.getSystemService(Context.TELEPHONY_SERVICE);

		final String tmDevice, tmSerial, androidId;
		tmDevice	= "" + tm.getDeviceId();
		tmSerial	= "" + tm.getSimSerialNumber();
		androidId	= "" + android.provider.Settings.Secure.getString(
						context.getContentResolver(),
						android.provider.Settings.Secure.ANDROID_ID);

		UUID deviceUuid = new UUID(androidId.hashCode(),
				((long) tmDevice.hashCode() << 32) | tmSerial.hashCode());
		return deviceUuid.toString();
	}

}
