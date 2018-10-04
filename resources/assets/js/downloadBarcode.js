

export default {
    
    init()
    {
        var links = document.querySelectorAll('a.download');
        for (var i in links) {
            if (!links.hasOwnProperty(i)) continue;
            links[i].addEventListener('click', function(event) {
                this.downloadCanvas(event.currentTarget, 'canvas');
            }.bind(this), false);
        }
    },

    downloadCanvas(link, canvasId) {
        var canvas = document.getElementById(canvasId);
        JsBarcode(canvas, link.dataset['barcode'], {
            format: "EAN13",
            width: 1,
            height: 20,
            marginTop: 20
        });

        // Add text
        var ctx = canvas.getContext("2d");
        ctx.font = "12px Monospace";
        ctx.fillText(link.dataset['name'], -50, 15);
        
        link.href = canvas.toDataURL();
        link.download = 'barcode_'+ link.dataset['name'] + '.png';
    }
};

