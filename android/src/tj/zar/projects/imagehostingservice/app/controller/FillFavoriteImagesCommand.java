package tj.zar.projects.imagehostingservice.app.controller;

import tj.zar.java.patterns.common.Command;
import tj.zar.projects.imagehostingservice.app.model.vo.ImageVo;
import tj.zar.projects.imagehostingservice.app.view.HomeActivityViewMediator;

/**
 * Fills activity's view with favorite images.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public class FillFavoriteImagesCommand implements Command {

	// -----------------------------------------------
	// Private fields
	// -----------------------------------------------

	/**
	 * View mediator used to show favorite images.
	 */
	private HomeActivityViewMediator viewMediator;

	// -----------------------------------------------
	// Constructors
	// -----------------------------------------------

	/**
	 * 
	 * @param viewMediator - View mediator used to show favorite images.
	 */
	public FillFavoriteImagesCommand(HomeActivityViewMediator viewMediator) {
		this.viewMediator = viewMediator;
	}

	// -----------------------------------------------
	// Overridden methods (from Command)
	// -----------------------------------------------

	@Override
	public void execute(Object data) {
		if (viewMediator != null && data != null && data instanceof ImageVo[]) {
			viewMediator.fillFavoriteImages((ImageVo[]) data);
		}
	}
	
}
