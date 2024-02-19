<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>{{$url['title']}}</title>
        <meta property="og:image" content="{{asset('images/og/'.$url['og'])}}" />
        <link rel="icon" type="image/x-icon" href="{{asset('images/og/'.$url['og'])}}">

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
            integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />

        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap");

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Poppins", sans-serif;
            }
            .container .loading {
                position: relative;
                display: flex;
                background: linear-gradient(#616161 0%, #333 10%, #222);
                border: 2px solid #000;
                padding: 10px;
                border-radius: 8px;
                box-shadow: 0 20px 35px rgba(0, 0, 0, 0.5);
                margin-top: 20px;
            }

            .container .loading::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 50%;
                background: rgba(255, 255, 255, 0.1);
                z-index: 10;
                pointer-events: none;
            }

            .container .loading::after {
                content: "";
                position: absolute;
                top: 15px;
                right: 20px;
                width: 10px;
                height: 10px;
                border-radius: 10px;
                background: #22e4e3;
                box-shadow: 0 0 5px #22e4e3, 0 0 10px #22e4e3, 0 0 40px #22e4e3;
                animation: animateLight 1s linear infinite;
            }

            @keyframes animateLight {
                0%,
                49.99% {
                    background: #22e4e3;
                    box-shadow: 0 0 5px #22e4e3, 0 0 10px #22e4e3, 0 0 40px #22e4e3;
                }
                50%,
                100% {
                    background: #111;
                    box-shadow: none;
                }
            }

            .container .loading .text {
                position: relative;
                width: 80px;
                color: #fff;
                text-align: right;
                letter-spacing: 1px;
                font-size: 12px;
            }

            .container .loading .percent {
                position: relative;
                top: 2px;
                width: calc(100% - 120px);
                height: 20px;
                background: #151515;
                border-radius: 20px;
                margin: 0 10px;
                box-shadow: inset 0 0 10px #000;
                overflow: hidden;
            }

            .container .loading .percent .progress {
                position: absolute;
                top: 0;
                left: 0;
                width: 0;
                height: 100%;
                border-radius: 20px;
                background: linear-gradient(45deg, #22ffde, #2196f3);
                animation: animate 6s ease-in-out infinite;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="loading">
                <span class="text" id="loading_time">Loading...</span>
                <div class="percent">
                    <div class="progress"></div>
                </div>
            </div>

            <div style="margin-top: 30px;" class="row">
                <div class="col-12">

                    @if ($url['view_page'] == 0)
                        @php echo $management['default'] @endphp
                    @else
                        @php echo $url['custom_page'] @endphp
                    @endif

                </div>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            let int_loading = {{$url['time']}};
            let loading = {{$url['time']}};
            var x = setInterval(() => {
                loading--;
                $("#loading_time").html(`Loading ${loading}s`);
                if(loading < 1){
                    clearInterval(x);
                    window.location.href='{{session()->get('url')}}';
                }

                $(".container .loading .percent .progress").css('width', `${(100/int_loading)*(int_loading-loading)}%`)
                console.log(loading);
            }, 1000);

        </script>

    </body>
</html>
