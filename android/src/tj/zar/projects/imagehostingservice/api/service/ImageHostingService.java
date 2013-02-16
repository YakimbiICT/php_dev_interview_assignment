package tj.zar.projects.imagehostingservice.api.service;

/**
 * Provides functionality to access Image Hosting Server on the remote server.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public interface ImageHostingService {

	/**
	 * Obtains random generated (non favorite) images from the remote server.
	 */
	void  obtainImages(ImageReceiveListener listener);
	
	/**
	 * Obtains the list of favorite images from the remote server.
	 */
	void obtainFavoriteImages(ImageReceiveListener listener);

	/**
	 * Sends request to the remote server to generate images from the Flikr
	 * image service.
	 * 
	 * @param listener
	 *            - listener to listen to new generated images array
	 */
	void generateFlikrImages(ImageReceiveListener listener);

	/**
	 * Sends request to the remote server to generate images from the Instagram
	 * image service.
	 * 
	 * @param listener
	 *            - listener to listen to new generated images array
	 */
	void generateInstagramImages(ImageReceiveListener listener);

	/**
	 * Sends request to the remote server to set image as favorite.
	 * 
	 * @param image
	 *            - image to be set as favorite
	 */
	void setFavorite(Image image);

	/**
	 * Sends request to the remote server to remove favorite status from the
	 * given image.
	 * 
	 * @param image
	 *            - image to be set as non favorite
	 */
	void removeFavorite(Image image);
	
	/**
	 * Saves description on the server of the given image.
	 * 
	 * @param image
	 *            - image with new description
	 */
	void setDescription(Image image);

}
