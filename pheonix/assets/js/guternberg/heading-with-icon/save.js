import { RichText } from '@wordpress/block-editor';


const save = (props) => {
    return (
        <div className="pheonix-block-heading">
            <RichText.Content
                tagName="h3"
                value={props.attributes.content}
            />
        </div>
    );
}

export default save;