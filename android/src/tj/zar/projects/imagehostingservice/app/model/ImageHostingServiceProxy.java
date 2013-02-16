package tj.zar.projects.imagehostingservice.app.model;

import tj.zar.java.patterns.common.Command;
import tj.zar.projects.imagehostingservice.app.model.vo.ImageVo;

/**
 * Proxy to the ImageHostingService components. Controllers and Views work only
 * with proxies, so they doesn't know how proxies really work.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public interface ImageHostingServiceProxy {

	/**
	 * Obtains image data (random, non favorite images) from the image hosting
	 * service.
	 * 
	 * @param successCommand
	 *            - command to be executed when image obtain complete
	 * @param errorCommand
	 *            - command to be executed when error occur during image obtain
	 */
	void obtainImages(Command successCommand, Command errorCommand);

	/**
	 * Obtains favorite images data from the image hosting service.
	 * 
	 * @param successCommand
	 *            - command to be executed when image obtain complete
	 * @param errorCommand
	 *            - command to be executed when error occur during image obtain
	 */
	void obtainFavoriteImages(Command successCommand, Command errorCommand);

	/**
	 * Generates new images from the Flikr on the image hosting service and
	 * returns new generated list.
	 * 
	 * @param successCommand
	 *            - command to be executed when image generate and obtain
	 *            complete
	 * @param errorCommand
	 *            - command to be executed when error occur during image
	 *            generate and obtain
	 */
	void generateFlikrImages(Command successCommand, Command errorCommand);

	/**
	 * Generates new images from the Instagram on the image hosting service and
	 * returns new generated list.
	 * 
	 * @param successCommand
	 *            - command to be executed when image generate and obtain
	 *            complete
	 * @param errorCommand
	 *            - command to be executed when error occur during image
	 *            generate and obtain
	 */
	void generateInstagramImages(Command successCommand, Command errorCommand);

	/**
	 * Sends request to the image hosting service to set specific
	 * {@link ImageVo} as favorite.
	 * 
	 * @param imageVo
	 *            - image to be set as favorite
	 */
	void setFavorite(ImageVo imageVo);

	/**
	 * Sends request to the image hosting service to remove specific
	 * {@link ImageVo} from the favorite list.
	 * 
	 * @param imageVo
	 *            - image to be remove from the favorite list
	 */
	void removeFavorite(ImageVo imageVo);

	/**
	 * Sends request to the image hosting service to set description of the
	 * specific {@link ImageVo}.
	 * 
	 * @param imageVo
	 *            - image's description used to be new image description
	 */
	void setDescription(ImageVo imageVo);

}
