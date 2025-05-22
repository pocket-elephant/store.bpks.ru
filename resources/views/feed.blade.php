<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<yml_catalog date="2020-11-22T14:37:38+03:00">
    <shop>
        <name>{{ config('app.name') }}</name>
        <company>{{ config('app.name') }}</company>
        <url>{{ config('app.url') }}</url>
        <currencies>
            <currency id="RUR" rate="1"/>
        </currencies>
        <categories>
            @foreach($categories as $category)
                <category id="{{ $category->id }}">{{ $category->name }}</category>
            @endforeach
        </categories>
        <offers>
            @foreach($products as $product)
                <offer id="{{ $product->id }}" available="true">
                    <name>{{ $product->name }}</name>
                    <url>{{ route('products.show', $product) }}</url>
                    <price>{{ $product->price }}</price>
                    <picture>{{ url('images/7d7aa485360f11f09f9f5a9ae9f12258.jpeg') }}</picture>
                    <currencyId>RUR</currencyId>
                    <categoryId>{{ $product->category_id }}</categoryId>
                    <delivery>true</delivery>
                </offer>
            @endforeach
        </offers>
    </shop>
</yml_catalog>
