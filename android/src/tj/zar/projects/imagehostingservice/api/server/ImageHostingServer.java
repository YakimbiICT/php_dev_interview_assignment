package tj.zar.projects.imagehostingservice.api.server;

/**
 * Provides access API to the remote image hosting service server.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public interface ImageHostingServer {

	/**
	 * API URL to access to the image list.
	 * 
	 * @return list of random images URL
	 */
	String getImagesUrl();
	
	/**
	 * API URL to access to the favorite image list.
	 * 
	 * @return list of favorite images URL
	 */
	String getFavoriteImagesUrl();

	/**
	 * API URL to generate random images from flikr service.
	 * 
	 * @return generate new random images from flikr URL
	 */
	String generateFlikrImagesUrl();

	/**
	 * API URL to generate random images from Instagram service.
	 * 
	 * @return generate new random images from Instagram URL
	 */
	String generateInstagramImagesUrl();

	/**
	 * API URL to add image to the list of favorite images.
	 * 
	 * @param id
	 *            - id of the image to be added to the favorite image list.
	 * @return add new favorite image with id = {id} URL
	 */
	String addFavoriteImageUrl(String id);

	/**
	 * API URL to remove image from the list of favorite images.
	 * 
	 * @param id
	 *            - id of the image to be removed from the favorite image list.
	 * @return remove image from the favorite list with id = {id} URL
	 */
	String removeFavoriteImageUrl(String id);

	/**
	 * API URL to add description to the image.
	 * 
	 * @param id
	 *            - id of the image to which description will be added.
	 * @return add image description to the image with id = {id} URL
	 */
	String addDescriptionUrl(String id);

	/**
	 * API URL to remove description to the image.
	 * 
	 * @param id
	 *            - id of the image from which description will be remove.
	 * @return remove image description from the image with id = {id} URL
	 */
	String removeDescriptionUrl(String id);

}
