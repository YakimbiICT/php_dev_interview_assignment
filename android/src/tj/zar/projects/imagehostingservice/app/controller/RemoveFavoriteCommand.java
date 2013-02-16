package tj.zar.projects.imagehostingservice.app.controller;

import tj.zar.java.patterns.common.Command;
import tj.zar.projects.imagehostingservice.app.model.ImageHostingServiceProxy;
import tj.zar.projects.imagehostingservice.app.model.vo.ImageVo;

/**
 * Removes image from the favorite list.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public class RemoveFavoriteCommand implements Command {

	// -----------------------------------------------
	// Private fields
	// -----------------------------------------------

	/**
	 * Image Hosting Service proxy used to remove image from the favorite image
	 * list.
	 */
	private ImageHostingServiceProxy imageServiceProxy;

	// -----------------------------------------------
	// Constructors
	// -----------------------------------------------

	/**
	 * 
	 * @param imageServiceProxy
	 *            - {@link ImageHostingServiceProxy} implementation used remove
	 *            image from the favorite image list.
	 */
	public RemoveFavoriteCommand(ImageHostingServiceProxy imageServiceProxy) {
		this.imageServiceProxy = imageServiceProxy;
	}

	// -----------------------------------------------
	// Overridden methods (from Command)
	// -----------------------------------------------

	@Override
	public void execute(Object data) {
		
		if (data != null && data instanceof ImageVo) {
			ImageVo image = (ImageVo) data;
			imageServiceProxy.removeFavorite(image);
		}
		
	}
	
}
