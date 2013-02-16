package tj.zar.projects.imagehostingservice.app.controller;

import tj.zar.java.patterns.common.Command;
import tj.zar.projects.imagehostingservice.app.model.vo.ImageVo;
import tj.zar.projects.imagehostingservice.app.view.HomeActivityViewMediator;

/**
 * Fills activity's view with non-favorite (random) images.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public class FillRandomImagesCommand implements Command {

	// -----------------------------------------------
	// Private fields
	// -----------------------------------------------

	/**
	 * View mediator used to show non-favorite (random) images.
	 */
	private HomeActivityViewMediator viewMediator;

	// -----------------------------------------------
	// Constructors
	// -----------------------------------------------

	/**
	 * 
	 * @param viewMediator
	 *            - View mediator used to show non-favorite (random) images.
	 */
	public FillRandomImagesCommand(HomeActivityViewMediator viewMediator) {
		this.viewMediator = viewMediator;
	}

	// -----------------------------------------------
	// Overridden methods (from Command)
	// -----------------------------------------------

	@Override
	public void execute(Object data) {
		if (viewMediator != null && data != null && data instanceof ImageVo[]) {
			viewMediator.fillRandomImages((ImageVo[]) data);
		}
	}
	
}
