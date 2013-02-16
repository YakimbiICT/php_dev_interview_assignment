package tj.zar.projects.imagehostingservice.api.service;

import java.io.ByteArrayOutputStream;

import org.json.JSONArray;
import org.json.JSONException;

import tj.zar.android.util.http.IPostRequestListener;

/**
 * Listens to the remote requests of the image list.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
class ImagesRequestListener implements IPostRequestListener {

	// -----------------------------------------------
	// Private fields
	// -----------------------------------------------
	
	/**
	 * Listener used to listen to image requests.
	 */
	private ImageReceiveListener listener;

	// -----------------------------------------------
	// Constructors
	// -----------------------------------------------

	/**
	 * 
	 * @param listener
	 *            - listener used to listen to image requests.
	 */
	ImagesRequestListener(ImageReceiveListener listener) {
		this.listener = listener;
	}

	// -----------------------------------------------
	// Overridden methods (from IPostRequestListener)
	// -----------------------------------------------

	@Override
	public void onError(Exception error) {
		if (listener != null) {
			listener.onError(error.toString());
		}
	}

	@Override
	public void onLoading(long loaded, int total) {
	}

	@Override
	public void onComplete(ByteArrayOutputStream output) {
		if (listener != null) {
			Image[] images = convertOutputToImages(output.toString());
			if (images != null)
				listener.onReceive(images);
			else
				listener.onError("Recieved image list is empty!");
		}
	}

	// -----------------------------------------------
	// Private methods
	// -----------------------------------------------

	/**
	 * Converts raw json string data to Image objects.
	 * 
	 * @param output
	 *            - json data to be converted to images.
	 * 
	 * @return Image[] array if string output is correct json data, null
	 *         otherwise.
	 */
	private Image[] convertOutputToImages(String output) {
		try {
			JSONArray json = new JSONArray(output);
			Image[] images = new Image[json.length()];
			for (int i = 0; i < json.length(); i++) {
				images[i] = new Image();
				images[i].decodeJSON(json.getJSONObject(i));
			}
			return images;
			
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return null;
	}
}