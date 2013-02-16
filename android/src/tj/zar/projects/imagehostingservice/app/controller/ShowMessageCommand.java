package tj.zar.projects.imagehostingservice.app.controller;

import tj.zar.java.patterns.common.Command;
import tj.zar.projects.imagehostingservice.app.view.HomeActivityViewMediator;

/**
 * Shows simple string message to the user.
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public class ShowMessageCommand implements Command {

	// -----------------------------------------------
	// Private fields
	// -----------------------------------------------

	/**
	 * View mediator used to show message.
	 */
	private HomeActivityViewMediator viewMediator;

	// -----------------------------------------------
	// Constructors
	// -----------------------------------------------

	/**
	 * 
	 * @param viewMediator - View mediator used to show message.
	 */
	public ShowMessageCommand(HomeActivityViewMediator viewMediator) {
		this.viewMediator = viewMediator;
	}

	// -----------------------------------------------
	// Overridden methods (from Command)
	// -----------------------------------------------

	@Override
	public void execute(Object data) {
		if (viewMediator != null && data != null && data instanceof String) {
			viewMediator.showMessage((String) data);
		}
	}
	
}
