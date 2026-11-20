<div class="hero-slider-wrap">
  <div class="slider">
    <div class="list">
      @foreach ([false, true] as $isDuplicate)
        <div class="group" @if ($isDuplicate) aria-hidden="true" @endif>
          @foreach (['01','02','03','04','05','06','07','08','10'] as $position => $photo)
            <div class="item">
              <div class="card">
                <img
                  src="/images/produk/foto-{{ $photo }}.jpg"
                  alt="{{ $isDuplicate ? '' : 'Cake Mom Sitty ' . ($position + 1) }}"
                >
              </div>
            </div>
          @endforeach
        </div>
      @endforeach
    </div>
  </div>
</div>
