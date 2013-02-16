package tj.zar.projects.imagehostingservice.app.controller;

import tj.zar.java.patterns.common.Command;
import tj.zar.projects.imagehostingservice.app.model.ImageHostingServiceProxy;
import tj.zar.projects.imagehostingservice.app.model.vo.ImageVo;

/**
 * Sets description of the image.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public class AddDescriptionCommand implements Command {

	// -----------------------------------------------
	// Private fields
	// -----------------------------------------------

	/**
	 * Image Hosting Service proxy used to set new description.
	 */
	private ImageHostingServiceProxy imageServiceProxy;

	// -----------------------------------------------
	// Constructors
	// -----------------------------------------------

	/**
	 * 
	 * @param imageServiceProxy
	 *            - {@link ImageHostingServiceProxy} implementation used to set
	 *            new description.
	 */
	public AddDescriptionCommand(ImageHostingServiceProxy imageServiceProxy) {
		this.imageServiceProxy = imageServiceProxy;
	}

	// -----------------------------------------------
	// Overridden methods (from Command)
	// -----------------------------------------------

	@Override
	public void execute(Object data) {
		
		if (data != null && data instanceof ImageVo) {
			ImageVo image = (ImageVo) data;
			imageServiceProxy.setDescription(image);
		}
	}
	
}
