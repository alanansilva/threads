<!-- footer -->
<div class="copy-right">
    <div class="container">
        <p>Copyright &copy; 2015 Bigwig. All Rights Reserved | Design by  <a href="http://w3layouts.com/"> W3layouts</a></p>
    </div>
</div>
<!-- footer -->

<style>
    /* Início botão Topo */
    #back-top {
        position: fixed;
        bottom: 0;
        right: 30px;
    }
    #back-top a {
        display: block;
        text-align: center;
        font: 11px/100% Arial, Helvetica, sans-serif;
        text-transform: uppercase;
        text-decoration: none;
        color: #000;
        -webkit-transition: 1s;
        -moz-transition: 1s;
        transition: 1s;
        outline: none;
    }
    #back-top a:hover {
        color: #000;
        outline: none;
    }
    #back-top span {
        display: block;
        /*margin-bottom: 7px;*/
        background: #fff;
        -webkit-transition: 1s;
        -moz-transition: 1s;
        transition: 1s;
        border: 1px solid #ccc;

        width: 35px;
        height: 35px;
    }
    #back-top a:hover span {
        background-color: #E7E7E7;
    }
    #back-top a span .glyphicon {
        line-height: 35px;
        /*color: #A31D21;*/
    }
    /* Fim botão Topo */
</style>
<script>
    $(document).ready(function () {
        // Scroll to TOP
        $("#back-top").hide();
        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    $('#back-top').slideDown();
                } else {
                    $('#back-top').slideUp();
                }
            });
            $('#back-top a').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });
    });
</script>
<p id="back-top">
    <a href="#top"><span><i class="glyphicon glyphicon-chevron-up classe_geral_cor"></i></span></a>
</p>

</body>
</html>