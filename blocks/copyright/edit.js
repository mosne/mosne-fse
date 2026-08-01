import { useBlockProps, RichText } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

/**
 * @param {Object}   props
 * @param {Object}   props.attributes
 * @param {Function} props.setAttributes
 * @return {JSX.Element}
 */
export default function Edit( { attributes, setAttributes } ) {
	const { text } = attributes;
	const year = new Date().getFullYear();
	const blockProps = useBlockProps( {
		className: 'mosne-copyright',
	} );

	return (
		<p { ...blockProps }>
			<span className="mosne-copyright__prefix">
				&copy; { year }{ ' ' }
			</span>
			<RichText
				tagName="span"
				className="mosne-copyright__text"
				value={ text }
				onChange={ ( value ) => setAttributes( { text: value } ) }
				placeholder={ __(
					'Add copyright text…',
					'mosne'
				) }
				allowedFormats={ [] }
			/>
		</p>
	);
}
