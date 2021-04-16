/**
 * External dependencies.
 */
import { Component } from '@wordpress/element';
import axios from 'axios';

class Test extends Component {
	constructor(props) {
    	super(props);
    	
    	this.state = {
			text: 'Select a file and upload will start automatically',
			loader: false,
			importedObjects: []
		};
	}
	/**
	 * Renders the component.
	 *
	 * @return {Object}
	 */
	render() {
		let {loader} = this.state;

		return (
			<div className="crb_import_field">
				crb_teeeeest
			</div>
		);
	}
}

export default Test;