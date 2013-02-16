package tj.zar.projects.imagehostingservice.api.server;

/**
 * {@link ImageHostingServer} implementation used to work with ZAR.TJ server.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public class ZarImageHostingServer implements ImageHostingServer {

	// -----------------------------------------------
	// Constants
	// -----------------------------------------------

	/**
	 * Server base URL.
	 */
	private static final String SERVER = "http://imagehosting.zar.tj/api/";

	// -----------------------------------------------
	// Overridden methods (from ImageHostingServer)
	// -----------------------------------------------

	@Override
	public String getImagesUrl() {
		return SERVER;
	}

	@Override
	public String getFavoriteImagesUrl() {
		return SERVER + "favorite/";
	}

	@Override
	public String generateFlikrImagesUrl() {
		return SERVER + "flikr/";
	}

	@Override
	public String generateInstagramImagesUrl() {
		return SERVER + "instagram/";
	}

	@Override
	public String addFavoriteImageUrl(String id) {
		return SERVER + "favorite/add/" + id;
	}

	@Override
	public String removeFavoriteImageUrl(String id) {
		return SERVER + "favorite/remove/" + id;
	}

	@Override
	public String addDescriptionUrl(String id) {
		return SERVER + "favorite/" + id + "/description/add/";
	}

	@Override
	public String removeDescriptionUrl(String id) {
		return SERVER + "favorite/" + id + "/description/remove/";
	}

}
