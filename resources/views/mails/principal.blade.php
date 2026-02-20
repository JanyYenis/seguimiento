@extends('mails.index')

@section('content')
    <td align="left" valign="center">
        <div style="text-align:left; margin: 0 20px; padding: 40px; background-color:#ffffff; border-radius: 6px">
            <!--begin:Email content-->
            <div style="padding-bottom: 30px; font-size: 17px;">
                {!! $descripcion !!}
            </div>
        </div>
    </td>
@endsection
