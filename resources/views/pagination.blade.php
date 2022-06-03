@if (isset($links) && is_array($links))
    <div style="padding: 10px; margin: 0 auto;">
        @foreach($links as $link)
            <a href="<?=$link[1];?>">
                <button class="btn <?=$link[2]?'btn-success':''?>"><?=$link[0];?></button>
            </a>
        @endforeach
    </div>
@endif
