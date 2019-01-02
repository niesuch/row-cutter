/**
 * Function used for form submit
 */
function submit() {
    document.getElementById("form").submit();
}
/**
 * Function marks text and copy to clipboard
 */
function copyClipboard() {
    if (document.selection) {
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById('parsed-text'));
        range.select().createTextRange();
        document.execCommand("copy");
    } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById('parsed-text'));
        window.getSelection().addRange(range);
        document.execCommand("copy");
    }
}