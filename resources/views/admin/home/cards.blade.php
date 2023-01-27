<div class="row">
    <div class="col-lg-3 col-md-4">
        <div class="card p-30 bg-danger">
            <div class="media widget-ten">
                <div class="media-left meida media-middle">
                    <span><i class="fa fa-calendar f-s-40 color-primary"></i></span>
                </div>
                <div class="media-body media-text-right">
                    <h2 class="color-white">
                        @if(!empty($data['confirmedEvents']))
                            {{ $data['confirmedEvents'] }}
                        @else
                            0
                        @endif
                    </h2>
                    <p class="m-b-0 color-white">Confirmed Events</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4">
        <div class="card p-30 bg-warning">
            <div class="media widget-ten">
                <div class="media-left meida media-middle">
                    <span><i class="fa fa-calendar f-s-40 color-success"></i></span>
                </div>
                <div class="media-body media-text-right">
                    <h2 class="color-white">
                        @if(!empty($data['unconfirmedEvents']))
                            {{ $data['unconfirmedEvents'] }}
                         @else
                            0
                        @endif
                    </h2>
                    <p class="m-b-0">Unconfirmed Events</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4">
        <div class="card p-30 bg-primary">
            <div class="media widget-ten">
                <div class="media-left meida media-middle">
                    <span><i class="fa fa-archive f-s-40 color-warning"></i></span>
                </div>
                <div class="media-body media-text-right">
                    <h2 class="color-white">
                        @if(!empty($data['gallery']))
                            {{ $data['gallery'] }}
                         @else
                            0
                        @endif
                    </h2>
                    <p class="m-b-0">Gallery items</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4">
        <div class="card p-30 bg-success">
            <div class="media widget-ten">
                <div class="media-left meida media-middle">
                    <span><i class="fa fa-user f-s-40 color-danger"></i></span>
                </div>
                <div class="media-body media-text-right">
                    <h2 class="color-white">
                        @if(!empty($data['partners']))
                            {{ $data['partners'] }}
                         @else
                            0
                        @endif
                    </h2>
                    <p class="m-b-0">Partners</p>
                </div>
            </div>
        </div>
    </div>
</div>