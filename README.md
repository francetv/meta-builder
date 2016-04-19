# Meta data builder

Help to build meta with php

## How to use

Extend AbstractMeta and implement getDefaultData();

### Data structure

```php
public function getDefaultData()
{
    return [
       "name_of_meta" => [
           ["attribute name" => "value of attribute", "second attribute name" => "value of attribute"],
       ]
  ]
}
```

Then, 

```
echo $meta->buildHtml(
    $meta->getDefaultData()   
);
```

```html
<meta attribute name="value of attribute" second attribute name="value of attribute" />
```

## Include templating

Extend constructor to add templating service. For example, twig.

```php
private $templating;

public function __construct($rootUrl, $uri, $templating)
{
    $this->templating = $templating;
}

public function buildHtml($meta)
{
    return $this->templating->render('meta/meta.html', ['metas' => $meta]);
}
```

In your twig

```html
{% block meta %}
    {% for meta in metas %}
        {% for attrs in meta %}
            {% spaceless %}
            <meta
            {% for (attrKey, attrValue) in $attrs %}
                  {{ attrKey }}="{{ attrValue }}" 
            {% endfor %}
            />
            {% endspaceless %}
        {% endfor %}    
    {% endfor %}
{% endblock %}
```

You may use some macro to refactor it.