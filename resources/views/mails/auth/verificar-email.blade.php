@extends('mails.index')

@section('content')
    <td align="left" valign="center">
        <div
            style="text-align:left; margin: 0 20px; padding: 40px; background-color:#ffffff; border-radius: 6px">

            <!--begin:Email content-->
            <div style="padding-bottom: 30px; font-size: 17px;">
                <strong>¡Bienvenidos a nuestra plataforma de drive!</strong>
            </div>

            <div style="padding-bottom: 30px">
                Para activar su cuenta, haga clic en el botón a continuación para verificar su dirección de correo electrónico.
                Una vez activado, tendrá acceso completo a nuestros productos gratuitos y premium.
            </div>

            <div style="padding-bottom: 40px; text-align:center;">
                <a href="https://keenthemes.com/account/confirm/07579ae29b6?email=max%40kt.com" rel="noopener" target="_blank"
                    style="text-decoration:none;display:inline-block;text-align:center;padding:0.75575rem 1.3rem;font-size:0.925rem;line-height:1.5;border-radius:0.35rem;color:#ffffff;background-color:#009ef7;border:0px;margin-right:0.75rem!important;font-weight:600!important;outline:none!important;vertical-align:middle">
                    Activar la cuenta
                </a>
            </div>

            <div style="border-bottom: 1px solid #eeeeee; margin: 15px 0"></div>

            <div style="padding-bottom: 50px; word-wrap: break-all;">
                <p style="margin-bottom: 10px;">
                    ¿El botón no funciona? Intente pegar esta URL en su navegador:
                </p>

                <a href="https://keenthemes.com/account/confirm/07579ae29b6?email=max%40kt.com"
                    rel="noopener" target="_blank" style="text-decoration:none;color: #009ef7">
                    https://keenthemes.com/account/confirm/07579ae29b6?email=max%40kt.com
                </a>
            </div>
            <!--end:Email content-->

            <div style="padding-bottom: 10px">
                K2 digital
            </div>
        </div>
    </td>
@endsection