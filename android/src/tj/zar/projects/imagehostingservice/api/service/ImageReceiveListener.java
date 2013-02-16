package tj.zar.projects.imagehostingservice.api.service;

/**
 * Listens to image obtain requests.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public interface ImageReceiveListener {

	/**
	 * Called when error occurs.
	 * 
	 * @param error
	 *            - string description of occurred error.
	 */
	void onError(String error);

	/**
	 * Called when images received from the remote server.
	 * 
	 * @param images
	 *            - array of {@link Image}s received from the remote server
	 */
	void onReceive(Image[] images);
	
}
