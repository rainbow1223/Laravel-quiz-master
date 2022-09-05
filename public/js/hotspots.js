$('.from_files').click(function () {
    $('#hotspots_only_from_files_image').trigger('click');
});

function hotspots_change_picture() {
    $('#hotspots_only_from_files_image').trigger('click');
}

var canvas = this.__canvas = new fabric.Canvas('hotspots_canvas');

// fabric.Object.prototype.transparentCorners = false;
var root_url = $('meta[name=url]').attr('content');

var canvas_info = $('#answer_content').val();

var canvas_bg_url = canvas_info.split('@')[0];
var canvas_item_info = canvas_info.split('@')[1];


if (canvas_info != '') {

    var json_bg_url = JSON.parse(canvas_bg_url);
    var json_canvas_item = JSON.parse(canvas_item_info);

    fabric.Image.fromURL(json_bg_url.background, function (img) {
        console.log(fit_canvas_image(canvas.width, canvas.height, img.width, img.height));
        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
            scaleX: fit_canvas_image(canvas.width, canvas.height, img.width, img.height).scaleFactor,
            scaleY: fit_canvas_image(canvas.width, canvas.height, img.width, img.height).scaleFactor,
            originX: 'left',
            originY: 'top',
            top: fit_canvas_image(canvas.width, canvas.height, img.width, img.height).top,
            left: fit_canvas_image(canvas.width, canvas.height, img.width, img.height).left,
            // scaleX: canvas.width / img.width, fit_canvas_image(canvas.width, canvas.height, img.width, img.height),
            //     scaleY: canvas.height / img.height
        });
    });

    console.log(json_canvas_item.type);

    if (json_canvas_item.type === 'circle') {

        canvas.add(new fabric.Circle({
            radius: json_canvas_item.radius,
            strokeWidth: 3,
            stroke: '#288f02',
            fill: '#c1fc8580',
            originX: 'center',
            originY: 'center',
            top: json_canvas_item.top,
            left: json_canvas_item.left
        }));
    }

    if (json_canvas_item.type === 'rect') {

        canvas.add(new fabric.Rect({
            width: json_canvas_item.width,
            height: json_canvas_item.height,
            strokeWidth: 3,
            stroke: '#288f02',
            fill: '#c1fc8580',
            top: json_canvas_item.top,
            left: json_canvas_item.left
        }));
    }

    if (json_canvas_item.type === 'polyline') {

        canvas.add(new fabric.Polygon(json_canvas_item.points, {
            strokeWidth: 3,
            stroke: '#288f02',
            fill: '#c1fc8580'
        }));
    }
    canvas.renderAll();

    var slide_view_canvas = new fabric.Canvas('slide_view_hotspots_canvas');

    fabric.Image.fromURL(json_bg_url.background, function (img) {
        slide_view_canvas.setBackgroundImage(img, slide_view_canvas.renderAll.bind(slide_view_canvas), {
            //  scaleX: 300 / img.width,
            // scaleY: 214 / img.height
            scaleX: fit_canvas_image(300, 214, img.width, img.height).scaleFactor,
            scaleY: fit_canvas_image(300, 214, img.width, img.height).scaleFactor,
            originX: 'left',
            originY: 'top',
            top: fit_canvas_image(canvas.width, canvas.height, img.width, img.height).top,
            left: fit_canvas_image(canvas.width, canvas.height, img.width, img.height).left,
        });
    });

    console.log(json_canvas_item.type);

    if (json_canvas_item.type === 'circle') {

        slide_view_canvas.add(new fabric.Circle({
            radius: json_canvas_item.radius,
            strokeWidth: 3,
            stroke: '#288f02',
            fill: '#c1fc8580',
            originX: 'center',
            originY: 'center',
            top: json_canvas_item.top,
            left: json_canvas_item.left
        }));
    }

    if (json_canvas_item.type === 'rect') {

        slide_view_canvas.add(new fabric.Rect({
            width: json_canvas_item.width,
            height: json_canvas_item.height,
            strokeWidth: 3,
            stroke: '#288f02',
            fill: '#c1fc8580',
            top: json_canvas_item.top,
            left: json_canvas_item.left
        }));
    }

    if (json_canvas_item.type === 'polyline') {

        slide_view_canvas.add(new fabric.Polygon(json_canvas_item.points, {
            strokeWidth: 3,
            stroke: '#288f02',
            fill: '#c1fc8580'
        }));
    }
    slide_view_canvas.renderAll();
}


$('#hotspots_only_from_files_image').change(function () {

    set_flag_true();
    canvas.setBackgroundColor('', canvas.renderAll.bind(canvas));
    canvas.setBackgroundImage(0, canvas.renderAll.bind(canvas));
    var root_url = $('meta[name=url]').attr('content');

    let reader = new FileReader();

    reader.onload = (e) => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let formData = new FormData();
        formData.append('image', e.target.result);
        formData.append('quiz_id', $("#quiz_id").val());

        $.ajax({
            type: 'POST',
            url: root_url + '/hotspots_image_upload',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
                    console.log(response);
                    var root_url = $('meta[name=url]').attr('content');
                    $('#answer_content').val('{"background": "' + root_url + '/' + response + '"}@{}');
                    console.log('Image has been uploaded successfully');
                }
            },
            error: function (response) {
                console.log(response);
                // $('#image-input-error').text(response.responseJSON.errors.file);
            }
        });

        fabric.Image.fromURL(e.target.result, function (img) {
            canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                scaleX: fit_canvas_image(canvas.width, canvas.height, img.width, img.height).scaleFactor,
                scaleY: fit_canvas_image(canvas.width, canvas.height, img.width, img.height).scaleFactor,
                originX: 'left',
                originY: 'top',
                top: fit_canvas_image(canvas.width, canvas.height, img.width, img.height).top,
                left: fit_canvas_image(canvas.width, canvas.height, img.width, img.height).left,
            });
        });
        $('#hotspots_image').attr('src', e.target.result);
        $('#hotspots_one_column').hide();
        $('#hotspots_two_columns').show();
    }

    reader.readAsDataURL(this.files[0]);

});


var line, isDown;

function drawcle() {
    $('#drawcle').addClass('hotspots_active');
    $('#drawrec').removeClass('hotspots_active');
    $('#drawpoly').removeClass('hotspots_active');

    set_flag_true();

    if (canvas.item(0) !== undefined) console.log(canvas.item(0));
    var circle, isDown, origX, origY, isDraw = false;
    removeEvents();
    canvas.on('mouse:down', function (o) {
        if (isDraw) return;
        isDown = true;
        var pointer = canvas.getPointer(o.e);
        origX = pointer.x;
        origY = pointer.y;
        circle = new fabric.Circle({
            left: pointer.x,
            top: pointer.y,
            radius: 1,
            strokeWidth: 3,
            stroke: '#288f02',
            fill: '#c1fc8580',
            originX: 'center',
            originY: 'center',
            // transparentCorners: false
        });
        canvas.add(circle);
    });

    canvas.on('mouse:move', function (o) {
        if (!isDown || isDraw) return;
        var pointer = canvas.getPointer(o.e);
        circle.set({
            radius: Math.abs(origX - pointer.x)
        });
        canvas.renderAll();
    });

    canvas.on('mouse:up', function (o) {
        if (isDraw) return;
        if (isDown) {
            canvas.getActiveObject().remove();
            canvas.add(circle);
            $('#drawcle').removeClass('hotspots_active');
            set_flag_true();
        }
        isDown = false;
        isDraw = true;
        console.log(canvas.item(0));
    });

}

function drawrec() {
    $('#drawrec').addClass('hotspots_active');
    $('#drawpoly').removeClass('hotspots_active');
    $('#drawcle').removeClass('hotspots_active');

    set_flag_true();
    var rect, isDown, origX, origY, isDraw = false;
    removeEvents();
    canvas.on('mouse:down', function (o) {
        if (isDraw) return;
        isDown = true;
        var pointer = canvas.getPointer(o.e);
        origX = pointer.x;
        origY = pointer.y;
        var pointer = canvas.getPointer(o.e);
        rect = new fabric.Rect({
            left: origX,
            top: origY,
            originX: 'left',
            originY: 'top',
            width: pointer.x - origX,
            height: pointer.y - origY,
            angle: 0,
            strokeWidth: 3,
            stroke: '#288f02',
            fill: '#c1fc8580',
            // transparentCorners: false
        });
        canvas.add(rect);
    });

    canvas.on('mouse:move', function (o) {
        if (!isDown || isDraw) return;
        var pointer = canvas.getPointer(o.e);

        if (origX > pointer.x) {
            rect.set({
                left: Math.abs(pointer.x)
            });
        }
        if (origY > pointer.y) {
            rect.set({
                top: Math.abs(pointer.y)
            });
        }

        rect.set({
            width: Math.abs(origX - pointer.x)
        });
        rect.set({
            height: Math.abs(origY - pointer.y)
        });


        canvas.renderAll();
    });

    canvas.on('mouse:up', function (o) {
        if (isDraw) return;
        if (isDown) {
            canvas.getActiveObject().remove();
            canvas.add(rect);
            set_flag_true();
            $('#drawrec').removeClass('hotspots_active');
        }
        isDown = false;
        isDraw = true;

    });
}

function removeEvents() {
    canvas.off('mouse:down');
    canvas.off('mouse:up');
    canvas.off('mouse:move');
}

function deleteCanvas() {
    canvas.getActiveObject().remove();
    set_flag_true();
}

/*********************************************
 *    *******      Polygen        *******     *
 **********************************************/
var roof = null;
var roofPoints = [];
var lines = [];
var lineCounter = 0;
var drawingObject = {};
drawingObject.type = "";
drawingObject.background = "";
drawingObject.border = "";

function Point(x, y) {
    this.x = x;
    this.y = y;
}


function drawpoly() {
    $('#drawpoly').addClass('hotspots_active');
    $('#drawrec').removeClass('hotspots_active');
    $('#drawcle').removeClass('hotspots_active');
    set_flag_true();
    if (drawingObject.type == "roof") {
        drawingObject.type = "";
        lines.forEach(function (value, index, ar) {
            canvas.remove(value);
        });
        //canvas.remove(lines[lineCounter - 1]);
        roof = makeRoof(roofPoints);
        canvas.add(roof);
        canvas.renderAll();
    } else {
        drawingObject.type = "roof"; // roof type
        console.log(drawingObject.type);
    }

    fabric.util.addListener(window, 'dblclick', function () {

        if (lines.length == 0) return;

        drawingObject.type = "";
        lines.forEach(function (value, index, ar) {
            canvas.remove(value);
        });
        //canvas.remove(lines[lineCounter - 1]);
        roof = makeRoof(roofPoints);
        canvas.add(roof);
        canvas.renderAll();

        $('#drawpoly').removeClass('hotspots_active');
        console.log("double click");
        //clear arrays
        roofPoints = [];
        lines = [];
        lineCounter = 0;

    });

    canvas.on('mouse:down', function (options) {
        console.log('down');
        if (drawingObject.type == "roof") {
            canvas.selection = false;
            setStartingPoint(options);
            console.log("----------------");
            console.log(x, y);// set x,y
            roofPoints.push(new Point(x, y));
            var points = [x, y, x, y];
            lines.push(new fabric.Line(points, {
                strokeWidth: 3,
                selectable: false,
                stroke: '#288f02',
                originX: 'center',
                originY: 'center'
            }));
            // }).setOriginX(x).setOriginY(y));
            canvas.add(lines[lineCounter]);
            lineCounter++;
            canvas.on('mouse:up', function (options) {
                console.log('up');
                canvas.selection = true;
            });
        }
    });
    canvas.on('mouse:move', function (options) {
        if (lines[0] !== null && lines[0] !== undefined && drawingObject.type == "roof") {
            setStartingPoint(options);
            lines[lineCounter - 1].set({
                x2: x,
                y2: y
            });
            canvas.renderAll();
        }
    });
}


// canvas Drawing
var x = 0;
var y = 0;

console.log(fabric.util);

// document.getElementsByClassName("upper-canvas")[0].addEventListener('dblclick', function () {
//
//     if (lines.length == 0) return;
//     drawingObject.type = "";
//     lines.forEach(function (value, index, ar) {
//         canvas.remove(value);
//     });
//     //canvas.remove(lines[lineCounter - 1]);
//     roof = makeRoof(roofPoints);
//     canvas.add(roof);
//     canvas.renderAll();
//
//     console.log("double click");
//     //clear arrays
//     roofPoints = [];
//     lines = [];
//     lineCounter = 0;
//
// });


function setStartingPoint(options) {
    var offset = $('#hotspots_canvas').offset();
    x = options.e.pageX - offset.left;
    y = options.e.pageY - offset.top;
    console.log(x, y);
}

function makeRoof(roofPoints) {

    var left = findLeftPaddingForRoof(roofPoints);
    var top = findTopPaddingForRoof(roofPoints);
    if (roofPoints.length == 0) return;

    roofPoints.push(new Point(roofPoints[0].x, roofPoints[0].y))
    var roof = new fabric.Polyline(roofPoints, {
        fill: '#c1fc8580',
        stroke: '#288f02',
        strokeWidth: 3,
    });
    roof.set({

        left: left,
        top: top,

    });


    return roof;
}

function findTopPaddingForRoof(roofPoints) {
    var result = 999999;
    for (var f = 0; f < lineCounter; f++) {
        if (roofPoints[f].y < result) {
            result = roofPoints[f].y;
        }
    }
    return Math.abs(result);
}

function findLeftPaddingForRoof(roofPoints) {
    var result = 999999;
    for (var i = 0; i < lineCounter; i++) {
        if (roofPoints[i].x < result) {
            result = roofPoints[i].x;
        }
    }
    return Math.abs(result);
}

function get_canvas() {
    return canvas;
}
