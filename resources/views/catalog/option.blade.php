
@if ($options)
    <div class="options ">
        {% for option in options %}
        @foreach($options as $option)
            @if ($option.type == 'select')
                <div class="form-group {{($option.required) ? 'required' :''}}">
                    <label class="control-label" for="input-option{{ option.product_variation_id }}">{{ option.name }}</label>

                    <select name="option[{{ option.product_variation_id }}]" id="input-option{{ option.product_variation_id }}" class="form-control">

                        {% for option_value in option.product_option_value %}
                        <option {{ (option.product_option_value|length  == 1 ) ? 'selected="selected"' : '' }} value="{{ option_value.product_option_value_id }}" data-image="{{ option_value.OpImage }}" data-pop="{{ option_value.OpImage_large }}">{{ option_value.name }}
                            {% if option_value.price %}
                            ({{ option_value.price_prefix }}{{ option_value.price }})
                            {% endif %} </option>
                        {% endfor %}
                    </select>
                </div>
            @endif

            {% if option.type == 'radio' %}
            <div class="form-group{% if option.required %} required {% endif %}">
                <label class="control-label">{{ option.name }}</label>
                <div id="input-option{{ option.product_option_id }}"> {% for option_value in option.product_option_value %}
                    <div class="radio">
                        <label>
                            <input type="radio" name="option[{{ option.product_option_id }}]" value="{{ option_value.product_option_value_id }}" />
                            {% if option_value.image %} <img src="{{ option_value.image }}" alt="{{ option_value.name }} {% if option_value.price %} {{ option_value.price_prefix }} {{ option_value.price }} {% endif %}" class="img-thumbnail" /> {% endif %}
                            {{ option_value.name }}
                            {% if option_value.price %}
                            ({{ option_value.price_prefix }}{{ option_value.price }})
                            {% endif %} </label>
                    </div>
                    {% endfor %} </div>
            </div>
            {% endif %}
            {% if option.type == 'checkbox' %}
            <div class="form-group{% if option.required %} required {% endif %}">
                <label class="control-label">{{ option.name }}</label>
                <div id="input-option{{ option.product_option_id }}"> {% for option_value in option.product_option_value %}
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="option[{{ option.product_option_id }}][]" value="{{ option_value.product_option_value_id }}" />
                            {% if option_value.image %} <img src="{{ option_value.image }}" alt="{{ option_value.name }} {% if option_value.price %} {{ option_value.price_prefix }} {{ option_value.price }} {% endif %}" class="img-thumbnail" /> {% endif %}
                            {{ option_value.name }}
                            {% if option_value.price %}
                            ({{ option_value.price_prefix }}{{ option_value.price }})
                            {% endif %} </label>
                    </div>
                    {% endfor %} </div>
            </div>
            {% endif %}
            {% if option.type == 'text' %}
            <div class="form-group{% if option.required %} required {% endif %}">
                <label class="control-label" for="input-option{{ option.product_option_id }}">{{ option.name }}</label>
                <input type="text" name="option[{{ option.product_option_id }}]" value="{{ option.value }}" placeholder="{{ option.name }}" id="input-option{{ option.product_option_id }}" class="form-control" />
            </div>
            {% endif %}
            {% if option.type == 'textarea' %}
            <div class="form-group{% if option.required %} required {% endif %}">
                <label class="control-label" for="input-option{{ option.product_option_id }}">{{ option.name }}</label>
                <textarea name="option[{{ option.product_option_id }}]" rows="5" placeholder="{{ option.name }}" id="input-option{{ option.product_option_id }}" class="form-control">{{ option.value }}</textarea>
            </div>
            {% endif %}
            {% if option.type == 'file' %}
            <div class="form-group{% if option.required %} required {% endif %}">
                <label class="control-label">{{ option.name }}</label>
                <button type="button" id="button-upload{{ option.product_option_id }}" data-loading-text="{{ text_loading }}" class="btn btn-default btn-block"><i class="fa fa-upload"></i> {{ button_upload }}</button>
                <input type="hidden" name="option[{{ option.product_option_id }}]" value="" id="input-option{{ option.product_option_id }}" />
            </div>
            {% endif %}
            {% if option.type == 'date' %}
            <div class="form-group{% if option.required %} required {% endif %}">
                <label class="control-label" for="input-option{{ option.product_option_id }}">{{ option.name }}</label>
                <div class="input-group date">
                    <input type="text" name="option[{{ option.product_option_id }}]" value="{{ option.value }}" data-date-format="YYYY-MM-DD" id="input-option{{ option.product_option_id }}" class="form-control" />
                    <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            {% endif %}
            {% if option.type == 'datetime' %}
            <div class="form-group{% if option.required %} required {% endif %}">
                <label class="control-label" for="input-option{{ option.product_option_id }}">{{ option.name }}</label>
                <div class="input-group datetime">
                    <input type="text" name="option[{{ option.product_option_id }}]" value="{{ option.value }}" data-date-format="YYYY-MM-DD HH:mm" id="input-option{{ option.product_option_id }}" class="form-control" />
                    <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            {% endif %}
            {% if option.type == 'time' %}
            <div class="form-group{% if option.required %} required {% endif %}">
                <label class="control-label" for="input-option{{ option.product_option_id }}">{{ option.name }}</label>
                <div class="input-group time">
                    <input type="text" name="option[{{ option.product_option_id }}]" value="{{ option.value }}" data-date-format="HH:mm" id="input-option{{ option.product_option_id }}" class="form-control" />
                    <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            {% endif %}
        @endforeach
    </div>
@endif