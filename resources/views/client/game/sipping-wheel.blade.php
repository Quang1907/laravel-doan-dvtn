@extends('layouts.client_master')
@section('title', 'Trang chu')

@section('styles')
    <style>
        #canvasContainer {
            background-image: url( "images/wheel_back.png" );
            background-repeat: no-repeat;   /* Ensure that background does not repeat */
            background-position: center;    /* Ensure image is centred */
            width: 700px;                   /* Width and height should at least be the same as the canvas */
            height: 500px;
        }
    </style>
@endsection

@section('content')
    <div class="text-4xl uppercase font-bold
    bg-gradient-to-r bg-clip-text  text-transparent
    from-indigo-500 via-yellow-500 to-indigo-500
    animate-text  m-auto text-center border-b-2 w-1/3 border-yellow-500 pt-3
    "> Vòng quay may mắn </div>
    <div class="my-5 flex">
        <div id="canvasContainer">
            <canvas id="canvas" width="700" height="500"
                data-responsiveMinWidth="180"
                data-responsiveScaleHeight="true"
                data-responsiveMargin="50"
                onClick="startSpin();">
            </canvas>
            <audio id="winsound">
                <source src="{{ asset( 'audio/winbeat.mp3') }}" />
            </audio>
        </div>
        <div style="margin: auto; display: block;">
            <div class="border-b-2 pb-3 border-blue-500">
                <button id='bigButton2' class='bigButton text-white btn bg-blue-500  hover:bg-blue-600' onClick="btnStart()">Spin the Wheel</button>
                <a href="javascript:void(0);" onClick="resetColourWheel(); bigButton2.disabled=false;" class="text-white btn bg-yellow-500  hover:bg-yellow-600 hover:text-white">Reset</a>
            </div>
            <div class="border-b-2 pb-3 border-blue-500">
                <h3 class="text-3xl uppercase mt-3">Nhập tên</h3>
                <input type="text" id="content" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"  style="display: block;">
                <div class="mt-3">
                    <button onClick="addSegment();" class="text-white btn bg-green-500  hover:bg-green-600">Thêm</button>
                    <button onClick="deleteSegment();" class="text-white btn bg-red-500  hover:bg-red-600">Delete Segment</button>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-center w-1/2 pt-3 m-auto  border border-spacing-20 border-blue-500 ">
        <div class="mb-5">
            <h2 class="text-3xl p-1 font-semibold uppercase bg-blue-500 text-white rounded">Lịch sử chiến thắng</h2>
            <ul id="win" class="list-decimal"></ul>
        </div>
    </div>
@endsection


@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset( 'js/toast.js' ) }}"></script>
<script src="{{ asset( 'js/Winwheel.js' ) }}"></script>

<script>

    let theWheel = new Winwheel({
        'canvasId'    : 'canvas',
        'outerRadius' : 215,    // Use these three properties to
        'centerX'     : 350,    // correctly position the wheel
        'centerY'     : 250,    // over the background.
        'numSegments' : 0,
        'responsive'   : true,
        'imageOverlay' : true,
        'fillStyle'   : '#1d3557',
        'textAlignment'  : 'center',
        'lineWidth'   : 3,
        'strokeStyle'  : '#051923',
        'rotationAngle'  : -(Math.random() * 50 ),
        'segments'    : [
        ],
        'animation' :                   // Note animation properties passed in constructor parameters.
        {
            'type'     : 'spinToStop',  // Type of animation.
            'duration' : 5,             // How long the animation is to take in seconds.
            'spins'        : 5,
            'soundTrigger'  : 'pin',
            'callbackFinished' : 'winAnimation()',
            'callbackSound' : playSound,
        },
        'pins' :    // Specify pin parameters.
        {
            'number'      : 18,
            'outerRadius' : 5,
            'margin'      : 10,
            'fillStyle'   : 'yellow',
            'strokeStyle' : 'white',
            'responsive' : true,
        },
    });

    function btnStart( ) {
        if ( (theWheel.segments).length > 2 ) {
            theWheel.startAnimation();
            this.disabled=true;
        }else{
            Swal.fire( 'Số lượng thành viên tham gia chưa đủ' )
        }
    }

    // Called by the onClick of the canvas, starts the spinning.
    function startSpin()
    {
       if ( (theWheel.segments).length > 2 ) {
         // Stop any current animation.
         theWheel.stopAnimation(false);

        // Reset the rotation angle to less than or equal to 360 so spinning again works as expected.
        // Setting to modulus (%) 360 keeps the current position.
        theWheel.rotationAngle = theWheel.rotationAngle % 360;

        // Start animation.
        theWheel.startAnimation();
        } else {
            Swal.fire( 'Số lượng tham gia chưa đủ' )
        }
    }

    let audio = new Audio( 'audio/tick.mp3' );  // Create audio object and load desired file.

    function playSound()
    {
        // Stop and rewind the sound (stops it if already playing).
        audio.pause();
        audio.currentTime = 0;

        // Play the sound.
        audio.play();
    }

    function addSegment()
    {
        var content = $( "#content" ).val();
        if ( content ) {
            theWheel.addSegment( {"fillStyle" : "#1d3557", "text": $( "#content" ).val(), "textFillStyle" : "white" }, 1 );
            theWheel.draw();
            $( "#content" ).val("");
        } else {
            Swal.fire( 'Hiện tại không có nội dung' )
        }
    }

    function deleteSegment()
    {
        if ( (theWheel.segments).length > 1 ) {
            Toast.fire({
                icon: 'success',
                title: 'Đã xoá thành công'
            })
            // Call function to remove a segment from the wheel, by default the last one will be
            // removed; you can pass in the number of the segment to delete if desired.
            theWheel.deleteSegment();

            // The draw method of the wheel object must be called to render the changes.
            theWheel.draw();
        } else {
            Swal.fire( 'Hiện tại chưa có nhân vật' )
        }
    }

    // This function called after the spin animation has stopped.
    function winAnimation()
    {
        // Call getIndicatedSegment() function to return pointer to the segment pointed to on wheel.
        let winningSegment = theWheel.getIndicatedSegment();
        // Basic alert of the segment text which is the prize name.
        if ( winningSegment.text ) {
            var win = document.getElementById("win");
            const node = document.createElement("li");
            node.setAttribute( "class", "text-xl font-semibold");
            var text = document.createTextNode( winningSegment.text );
            node.appendChild( text );
            win.appendChild( node );
        }

        Swal.fire({
            title: "You have won " + winningSegment.text + "!",
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            },
            confirmButtonText: 'Đồng ý',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if ( result.isConfirmed ) {
                resetColourWheel()
            }
        })

        // Get the audio with the sound it in, then play.
        let winsound = document.getElementById('winsound');
        winsound.play();

        // Get the number of the winning segment.
        let winningSegmentNumber = theWheel.getIndicatedSegmentNumber();

        // Loop and set fillStyle of all segments to gray.
        for (let x = 1; x < theWheel.segments.length; x ++) {
            theWheel.segments[x].fillStyle = '#1d3557';
        }

        // Make the winning one yellow.
        theWheel.segments[winningSegmentNumber].fillStyle = '#0077b6';

        // Call draw function to render changes.
        theWheel.draw();

        // Also re-draw the pointer, otherwise it disappears.
    }

    // Called when reset is clicked.
    function resetColourWheel()
    {
        // Stop animation and set angle back to 0.
        theWheel.stopAnimation(false);
        theWheel.rotationAngle = 0;
        (theWheel.segments).forEach( function ( value )  {
            if ( value ) {
                value.fillStyle = "#1d3557";
            }
        });

        // Call draw to render changes and then triangle function so pointer appears.
        theWheel.draw();
    }

</script>
@endsection
