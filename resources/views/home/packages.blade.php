<div class="row">
    @foreach ($popularPackages as $package)
        <div class="col-lg-4 col-md-6">
            <div class="package-wrap">
                <figure class="feature-image">
                    <a href="#">
                        <img src="{{ asset('storage/' . $package->brochure) }}" alt="Tour Image" onerror="this.src='{{ asset('assets/images/default-tour.jpg') }}'">
                    </a>
                </figure>
                <div class="package-price">
                    <h6>
                        <span>₱{{ number_format($package->price, 2) }} </span> / per person
                    </h6>
                </div>
                <div class="package-content-wrap">
                    <div class="package-meta text-center">
                        <ul>
                            <li><i class="far fa-clock"></i> {{ $package->duration_days }}D/{{ $package->duration_nights }}N</li>
                            <li><i class="fas fa-user-friends"></i> People: {{ $package->capacity }}</li>
                            <li><i class="fas fa-map-marker-alt"></i> {{ $package->title }}</li>
                        </ul>
                    </div>
                    <div class="package-content">
                        <h3>
                            <a href="#">{{ $package->title }}</a>
                        </h3>
                        <p>{!! \Illuminate\Support\Str::limit(strip_tags($package->description), 100) !!}</p>
                        <div class="btn-wrap">
                            <a href="{{ route('customer.tours.show', $package->api_tour_id) }}" class="button-text width-6">Book Now <i class="fas fa-arrow-right"></i></a>
                            <a href="#" class="button-text width-6">Wish List <i class="far fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
