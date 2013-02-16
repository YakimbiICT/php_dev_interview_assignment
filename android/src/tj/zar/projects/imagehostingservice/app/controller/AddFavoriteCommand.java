package tj.zar.projects.imagehostingservice.app.controller;

import tj.zar.java.patterns.common.Command;
import tj.zar.projects.imagehostingservice.app.model.ImageHostingServiceProxy;
import tj.zar.projects.imagehostingservice.app.model.vo.ImageVo;

/**
 * Sets image as a favorite image.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public class AddFavoriteCommand implements Command {

	// -----------------------------------------------
	// Private fields
	// -----------------------------------------------

	/**
	 * Image Hosting Service proxy used to set image as favorite.
	 */
	private ImageHostingServiceProxy imageServiceProxy;

	// -----------------------------------------------
	// Constructors
	// -----------------------------------------------

	/**
	 * 
	 * @param imageServiceProxy
	 *            - {@link ImageHostingServiceProxy} implementation used to set
	 *            image as favorite.
	 */
	public AddFavoriteCommand(ImageHostingServiceProxy imageServiceProxy) {
		this.imageServiceProxy = imageServiceProxy;
	}

	// -----------------------------------------------
	// Overridden methods (from Command)
	// -----------------------------------------------

	@Override
	public void execute(Object data) {
		
		if (data != null && data instanceof ImageVo) {
			ImageVo image = (ImageVo) data;
			imageServiceProxy.setFavorite(image);
		}
	}
	
}
