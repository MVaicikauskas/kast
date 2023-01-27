@switch($type)
    @case('facebook')
    <li>
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $share_link }}&t={{ $share_title }}"
           onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=350,width=600');return false;"
           target="_blank" title="Dalintis Facebook'e"
           class="facebook"><i class="fa fa-facebook"></i></a>
    </li>
    @break
    @case('messenger')
    <li class="d-md-none">
        <a href="fb-messenger://share/?link={{ $share_link }}&t={{ $share_title }}"
           target="_blank" title="Dalintis per Messenger"
           class="messenger"><svg style="height: 15px;margin-left: -2px;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-messenger" class="svg-inline--fa fa-facebook-messenger fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256.55 8C116.52 8 8 110.34 8 248.57c0 72.3 29.71 134.78 78.07 177.94 8.35 7.51 6.63 11.86 8.05 58.23A19.92 19.92 0 0 0 122 502.31c52.91-23.3 53.59-25.14 62.56-22.7C337.85 521.8 504 423.7 504 248.57 504 110.34 396.59 8 256.55 8zm149.24 185.13l-73 115.57a37.37 37.37 0 0 1-53.91 9.93l-58.08-43.47a15 15 0 0 0-18 0l-78.37 59.44c-10.46 7.93-24.16-4.6-17.11-15.67l73-115.57a37.36 37.36 0 0 1 53.91-9.93l58.06 43.46a15 15 0 0 0 18 0l78.41-59.38c10.44-7.98 24.14 4.54 17.09 15.62z"></path></svg></a>
    </li>
    @break
    @case('linkedin')
    <li>
        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $share_link }}&t={{ $share_title }}"
           onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600');return false;"
           target="_blank" title="Dalintis LinkedIn"
           class="linkedin"><i class="fa fa-linkedin"></i></a>
    </li>
    @break
    @case('copy')
    <li>
        <a href="{{$share_link}}" onclick="return copyToClipboard('{{$share_link}}', this)" title="Kopijuoti nuorodą į {{ $share_title }}" class="copy"><i class="fa fa-copy"></i></a>
    </li>
    @break
@endswitch