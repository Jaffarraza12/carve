@if ($productVariations)
    <div class="options ">
        @foreach($productVariations as $variation)
            @if ($variation->type == 'select')
                <div class="form-group {{($variation->required) ? 'required' :''}}">
                    <label class="control-label" for="input-option{{ $variation->product_variation_id }}">{{ $variation->name }}</label>
                    <select name="option[{{ $variation->variation_id }}]" id="input-option{{ $variation->variation_id }}" class="form-control">
                        @foreach($productVariationValues[$variation->variation_id] as $variation_value)
                        <option {{ ( count($productVariationValues[$variation->variation_id])  == 1 ) ? 'selected="selected"' : '' }} value="{{ $variation_value->value_id }}" >{{ $variation_value->name }}
                            @if($variation->price)
                            ({{ $variation->price_prefix }}{{ $variation->price }})
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if ($variation->type == 'radio')
                    <div class="form-group {{($variation->required) ? 'required' :''}}">
                        <label class="control-label">{{ $variation->name }}</label>
                        <div  id="input-option{{ $variation->variation_id }}">
                            @foreach($productVariationValues[$variation->variation_id] as $variation_value)
                            <div class="radio">
                                <label>
                                    <input type="radio" name="option[{{ $variation->variation_id }}]" value="{{ $variation_value->value_id }}" />
                                    {{ $variation_value->name }}
                                    @if($variation->price)
                                        ({{ $variation->price_prefix }}{{ $variation->price }})
                                    @endif </label>

                            </div>
                            @endforeach
                        </div>
                    </div>
            @endif
            @if ($variation->type == 'checkbox')
                    <div class="form-group {{($variation->required) ? 'required' :''}}">
                        <label class="control-label">{{ $variation->name }}</label>
                        <div  id="input-option{{ $variation->variation_id }}">
                            @foreach($productVariationValues[$variation->variation_id] as $variation_value)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="option[{{ $variation->variation_id }}]" value="{{ $variation_value->value_id }}" />
                                    {{ $variation_value->name }}
                                    @if($variation->price)
                                        ({{ $variation->price_prefix }}{{ $variation->price }})
                                    @endif </label>

                            </div>
                            @endforeach
                        </div>
                    </div>
            @endif
            @if ($variation->type == 'text')
                    <div class="form-group {{($variation->required) ? 'required' :''}}">
                        <label class="control-label" for="input-option{{ $variation->variation_id }}">{{ $variation->name }}</label>
                        <input type="text" name="option[{{ $variation->variation_id }}]" value="{{ $variation->value }}" placeholder="{{ $variation->name }}" id="input-option{{ $variation->variation_id }}" class="form-control" />
                    </div>
            @endif
            @if ($variation->type == 'textarea')
                    <div class="form-group {{($variation->required) ? 'required' :''}}">
                        <label class="control-label" for="input-option{{ $variation->variation_id }}">{{ $variation->name }}</label>
                        <textarea  name="option[{{ $variation->variation_id }}]"  id="input-option{{ $variation->variation_id }}" class="form-control" >{{ $variation->value }}</textarea>
                    </div>
            @endif
            @if ($variation->type == 'datetime')
                <div class="form-group {{($variation->required) ? 'required' :''}}">
                    <label class="control-label" for="input-option{{ $variation->variation_id }}">{{ $variation->name }}</label>
                    <div class="input-group datetime">
                        <input type="text" name="option[{{ $variation->variation_id }}]" data-date-format="YYYY-MM-DD HH:mm"  value="{{ $variation->value }}" placeholder="{{ $variation->name }}" id="input-option{{ $variation->variation_id }}" class="form-control" />
                        <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
                </div>
            @endif


        @endforeach
    </div>
@endif