import PropTypes from 'prop-types';

const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;
const { TextControl, ToggleControl } = wp.components;

class LinkComponent extends Component {

	constructor(props) {

		super( props );

		let value = this.props.control.setting.get()

		this.state = {
			value
		};
		
		this.onUrlChange = this.onUrlChange.bind(this);
		this.onCheckboxChange = this.onCheckboxChange.bind(this);
		this.onRelChange = this.onRelChange.bind(this);
	}
	onUrlChange( value ) {

		const obj = { 
			url: value,
			new_tab: this.state.value.new_tab,
			link_rel: this.state.value.link_rel
		};
		this.setState( { value : obj } )
		this.props.control.setting.set( obj );
	}
	onCheckboxChange( value ) {

		const obj = { 
			url: this.state.value.url,
			new_tab: value,
			link_rel: this.state.value.link_rel
		};
		this.setState( { value : obj } )
		this.props.control.setting.set( obj );
		
	}
	onRelChange ( value ) { 

		const obj = { 
			url: this.state.value.url,
			new_tab: this.state.value.new_tab,
			link_rel: value
		};
		this.setState( { value : obj } )
		this.props.control.setting.set( obj );
		
	}
	render() {

		const {
			value,
			label,
			settings
		} = this.props.control.params

		const {
			url,
			new_tab,
			link_rel
		} = this.state.value

		var name = settings.default;
		name = name.replace( '[', '-' );
		name = name.replace( ']', '' );
		
		return (
			
			<Fragment>
				{ label && (
					<label>
						<span className="customize-control-title">{ label }</span>
					</label>
				) }
				<div className="customize-control-content">
					<TextControl
						value={ url }
						className= { 'ast-link-input' }
						onChange={ (value) => {
							this.onUrlChange( value );
						} }
					/>
				</div>
				<div className="customize-control-content ast-link-open-in-new-tab-wrapper">
					<ToggleControl
						label={  __( 'Open in a New Tab' ) }
						checked={ new_tab }
						className="ast-link-open-in-new-tab"
						onChange={ ( value ) => this.onCheckboxChange( value ) }
					/>
				</div>
				<div className="customize-control-content">
					<label>
						<span className="customize-control-title">{ __( 'Button Link Rel' ) }</span>
					</label>
					<TextControl
						value={ link_rel }
						className= { 'ast-link-relationship' }
						onChange={ (value) => {
							this.onRelChange( value );
						} }
					/>
				</div>
				<input type="hidden" id={ `_customize-input-${ settings.default }` } className="customize-link-control-data" name={ name } data-customize-setting-link={ settings.default } data-value={ JSON.stringify( value ) }></input>
			</Fragment>
		);
	}
} 

LinkComponent.propTypes = {
	control: PropTypes.object.isRequired
};

export default LinkComponent;