$(function () {

    var greekChars = {
        "a": "\u03b1"
        // Add character mappings here
    };

    function convertCharToGreek(charStr) {
        var newElement = document.createElement('span');
        newElement.innerHTML = charStr;
        return newElement;
    }

    function insertTextAtCursor(text) {
        var sel, range, textNode;
        if (window.getSelection) {
            sel = window.getSelection();
            if (sel.getRangeAt && sel.rangeCount) {
                range = sel.getRangeAt(0);
                range.deleteContents();
                // textNode = document.createTextNode(text);
                textNode = text;
                range.insertNode(textNode);

                // Move caret to the end of the newly inserted text node
                range.setStart(range.commonAncestorContainer, range.startOffset);
                range.setEnd(range.commonAncestorContainer, range.startOffset);
                sel.removeAllRanges();
                sel.addRange(range);
            }
        } else if (document.selection && document.selection.createRange) {
            range = document.selection.createRange();
            range.pasteHTML(text);
        }
    }

    $('div[contenteditable="true"]').keypress(function (evt) {
        console.log(window.getSelection().getRangeAt(0));
        return;
        evt = evt || window.event;
        var charCode = (typeof evt.which == "undefined") ? evt.keyCode : evt.which;
        if (charCode) {
            var charStr = String.fromCharCode(charCode);
            console.log(charStr);
            var greek = convertCharToGreek(charStr);
            insertTextAtCursor(greek);
            return false;
        }
    });

    $('div[contenteditable="true"]').click(function () {
        console.log(window.getSelection().getRangeAt(0));
    });

    $('div[contenteditable="true"]').keydown(function () {
        var html = "";
        if (typeof window.getSelection != "undefined") {
            var sel = window.getSelection();
            if (sel.rangeCount) {
                var container = document.createElement("div");
                for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                    container.appendChild(sel.getRangeAt(i).cloneContents());
                }
                html = container.innerHTML;
            }
        } else if (typeof document.selection != "undefined") {
            if (document.selection.type == "Text") {
                html = document.selection.createRange().htmlText;
            }
        }
        console.log(html);
    });
});
