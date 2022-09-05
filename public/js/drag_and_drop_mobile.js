class Drag_and_drop_mobile {
    constructor(drag, drop, zoomScale, drag_and_drop_type) {
        this.drag = drag;
        this.drop = drop;
        this.drag_and_drop_type = drag_and_drop_type;
        this.zoomScale = zoomScale;
    }

    drag_and_drop() {
        this.drag.handle_drag(this.drop.droppable_element, this.zoomScale, this.drag_and_drop_type);
    }
}

class Drag {
    constructor(draggable_element) {
        this.draggable_element = draggable_element;
        this.parentPosition = {
            top: this.draggable_element.parent().offset().top,
            left: this.draggable_element.parent().offset().left,
        };
    }

    handle_drag(drop, zoomScale, type) {
        const parentPosition = this.parentPosition;
        const drag = this.draggable_element;
        let originPosition;
        let mouseGap;

        this.draggable_element.on('touchstart', function (e) {
            $(this).addClass('ui-state-highlight');

            originPosition = {
                top: $(this).offset().top,
                left: $(this).offset().left,
            };

            var touchLocation = e.targetTouches[0];

            mouseGap = {
                x: touchLocation.clientX - originPosition.left,
                y: touchLocation.clientY - originPosition.top,
            };
        });

        this.draggable_element.on('touchmove', function (e) {

            var touchLocation = e.targetTouches[0];
            var pageX, pageY;
            switch (type) {
                case 'matching':
                    if ($(this).parent().find('.tmp').length == 0) {
                        let tmp = $($(this)[0].outerHTML);
                        tmp.removeClass('ui-state-highlight');
                        tmp.addClass('tmp');
                        $(this).parent().append(tmp[0].outerHTML);
                    }

                    pageX = (touchLocation.clientX - parentPosition.left - mouseGap.x) / zoomScale + "px";
                    pageY = (touchLocation.clientY - parentPosition.top - mouseGap.y) / zoomScale + "px";
                    break;

                case 'drag_words':
                    pageX = (touchLocation.clientX - $(this).parent().offset().left - mouseGap.x) / zoomScale + "px";
                    pageY = (touchLocation.clientY - $(this).parent().offset().top - mouseGap.y) / zoomScale + "px";

                    break;
            }

            $(this).css({
                position: 'absolute',
                left: pageX,
                top: pageY,
            });

            for (let i = 0; i < drop.length; i++) {

                if (is_drop($(this), drop.eq(i), zoomScale)) {
                    drop.eq(i).addClass('ui-state-highlight');
                } else {
                    drop.eq(i).removeClass('ui-state-highlight');
                }
            }

        });

        this.draggable_element.on('touchend', function (e) {

            var index = get_drop_index($(this), drop, zoomScale);

            console.log(index);

            $('.ui-state-highlight').removeClass('ui-state-highlight');

            switch (type) {
                case 'matching':
                    $('.tmp').remove();
                    $(this).attr('style', 'width: 40%;');

                    if (index == -1) {
                        $(this).removeClass("ui-state-highlight");
                        $(this).parent().css({'justify-content': 'space-around'});
                    } else {
                        drop.eq(index).parent().css({'justify-content': 'center'});

                        var tmp_string = $(this).html();
                        $(this).html(drag.eq(index).html());
                        drag.eq(index).html(tmp_string);
                    }
                    break;

                case 'drag_words':
                    if (index > -1) {
                        insert_drag_words_array(index, $(this).html());
                    }
                    break;
            }
        });
    }
}

class Drop {
    constructor(droppable_element) {
        this.droppable_element = droppable_element;
    }
}

function detectTouchEnd(x1, y1, x2, y2, drop_w, drop_h, drag_w, drag_h, zoom) {

    if (x2 - x1 > drop_w * zoom || x1 - x2 > drag_w * zoom)
        return false;
    if (y2 - y1 > drop_h * zoom || y1 - y2 > drag_h * zoom)
        return false;
    return true;
}

function is_drop(drag, drop, zoom) {

    return detectTouchEnd(drop.offset().left, drop.offset().top, drag.offset().left, drag.offset().top, drop.width(), drop.height(), drag.width(), drag.height(), zoom);
}

function get_drop_index(drag, drop, zoomScale) {
    var index = -1;

    for (let i = 0; i < drop.length; i++) {
        if (is_drop(drag, drop.eq(i), zoomScale)) {
            index = i;
            return index;
        }
    }
    return index;
}
