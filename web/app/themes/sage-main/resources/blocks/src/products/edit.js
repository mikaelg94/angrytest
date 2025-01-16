/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { SelectControl,TextControl, Panel, PanelBody, PanelRow, Button, ComboboxControl } from '@wordpress/components';
import { store as coreDataStore } from '@wordpress/core-data';
import ServerSideRender from "@wordpress/server-side-render";

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({attributes, setAttributes}) {

	const posts = useSelect(
		( select ) => select( coreDataStore ).getEntityRecords('postType', 'product')
	);

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				<Panel>
					<PanelBody title={__('Settings', 'sage')}>
							<TextControl
								label={__('Title', 'gonera')}
								value={attributes.title}
								placeholder={__('Enter your title here...', 'gonera')}
								onChange={(title) => setAttributes({ title })}
							/>
							<SelectControl
								multiple
								label="Products"
								value={attributes.products}
								options={
									posts && posts.length > 0
										? [

											...posts.map((post) => ({
												label: post.title.rendered,
												value: post.id,
											})),
										]
										: [{label: 'No Posts Available', value: null}]
								}
								onChange={(products) => setAttributes({ products })}
							/>
					</PanelBody>
				</Panel>
			</InspectorControls>
			<ServerSideRender
				block="gonera/products"
				attributes={attributes}
			/>
		</div>
	);
}
