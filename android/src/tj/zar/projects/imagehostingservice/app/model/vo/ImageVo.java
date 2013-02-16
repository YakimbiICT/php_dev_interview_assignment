package tj.zar.projects.imagehostingservice.app.model.vo;

import tj.zar.projects.imagehostingservice.api.service.Image;

/**
 * Image value object. Used to represent Image data. Used to be shared between
 * Mediators and Proxies (Views and Models).
 * 
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
public class ImageVo {

	// -----------------------------------------------
	// Private fields
	// -----------------------------------------------

	/**
	 * This object's values will be used as {@link ImageVo} data.
	 */
	private Image image;
	
	/**
	 * Custom description of the image.
	 */
	private String description;

	// -----------------------------------------------
	// Constructor
	// -----------------------------------------------

	/**
	 * Constructs ImageVo using {@link Image}.
	 * 
	 * @param image
	 *            - {@link Image} instance which values would be used
	 */
	public ImageVo(Image image) {
		this.image = image;
	}

	// -----------------------------------------------
	// Getter methods
	// -----------------------------------------------
	
	/**
	 * Gets image's id.
	 * 
	 * @return image's id
	 */
	public String getId() {
		return image.getId();
	}

	/**
	 * Gets image's url.
	 * 
	 * @return image's url
	 */
	public String getUrl() {
		return image.getUrl();
	}

	/**
	 * Gets image's name.
	 * 
	 * @return image's name
	 */
	public String getName() {
		return image.getName();
	}

	/**
	 * Gets image's description.
	 * 
	 * @return image's description
	 */
	public String getDescription() {
		if (description != null)
			return description;

		return image.getDescription();
	}

	/**
	 * Sets new description to the image.
	 * 
	 * @param description
	 *            - new image description
	 */
	public void setDescription(String description) {
		this.description = description;
	}
	
}
