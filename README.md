Twig and  Twital Components
===========================

Define reusable components in Twig/Twital as in Vue/React style.

Installation
------------

Install this library via composer:

```shell script
composer install webuni/twig-components
```

and enable in Twig environment:

```php
use Twig\Environment;
use Webuni\TwigComponents\Twig\ComponentsExtension;

$twig = new Environment($loader, $options);
$twig->addExtension(new ComponentsExtension());
```

Usage
-----

### Scope

Everything in the parent template is compiled in parent scope;
everything in the child template is compiled in the child scope.

### Twital

Add `c:` prefix to a Twital attribute to indicate value as a Twig code. 

### Import components

https://github.com/vuejs/rfcs/pull/182

<table><tr><th>Twig</th><th>Twital</th></tr><tr><td>

```twig
{% component "button.html.twig" as "button" %}

{% component "button" %}
  …
{% endcomponent %}
```

</td><td>

```html
<c:component src="button.html.twig" as="button" />

<c:button>
  …
</c:button>
```

</td></tr></table>

### Dynamic components

https://v3.vuejs.org/guide/component-basics.html#dynamic-components

<table><tr><th>Twig</th><th>Twital</th></tr><tr><td>

```twig
{% component "button.html.twig" as "button" %}
{% component "group_button.html.twig" as "group_button" %}

{% component current_component %}
  …
{% endcomponent %}
```

</td><td>

```html
<c:component src="button.html.twig" as="button" />
<c:component src="group_button.html.twig" as="group_button" />

<c:component c:is="current_component">
  …
</c:component>
``` 

</td></tr></table>

### Slots

<table><tr><th>Twig</th><th>Twital</th></tr><tr><td>

```twig
<ul>
  {% for index, item in items %}
    <li>
      {% slot bind "item" %}{{ item }}{% endslot %}
    </li>
  {% endfor %}
</ul>
```

```twig
{% component "todo-list" %}
  {% template bind "slot_context" %}
    <i class="fas fa-check"></i>
    <span class="green">{{ slot_context.item }}<span>
  {% endtemplate %}
{% endcomponent %}
```

```twig
{% component "todo-list" %}
  {% template bind "{item}" %}
    <i class="fas fa-check"></i>
    <span class="green">{{ item }}<span>
  {% endtemplate %}
{% endcomponent %}
```

</td><td>

```html
<ul>
  <li t:for="index, item in items">
    <c:slot bind="item">{{ item }}</c:slot>
  </li>
</ul>
```

```html
<c:todo-list>
  <c:template bind="slot_context">
    <i class="fas fa-check"></i>
    <span class="green">{{ slot_context.item }}<span>
  </c:template>
</c:todo-list>
```

```html
<c:todo-list>
  <c:template bind="{item}">
    <i class="fas fa-check"></i>
    <span class="green">{{ item }}<span>
  </c:template>
</c:todo-list>
```

</td></tr></table>

### Bind

```html
<c:slot bind="item"></c:slot>
<c:slot bind="item = item"></c:slot>
<c:slot bind="{item}"></c:slot>
<c:slot bind="{item: item}"></c:slot>

<c:template slot="header" bind="item"></c:template>
<c:template slot="default" bind="item = item"></c:template>
<c:template bind="{item: item}"></c:template>
```

Multiple

```html
<c:slot bind="item, key"></c:slot>
<c:slot bind="item = item, key = key"></c:slot>
<c:slot bind="{item, key}"></c:slot>
<c:slot bind="{item: item, key: key}"></c:slot>
```

Dynamic bind

```html
<c:slot c:bind="{(item): 'item'}">{{ item }}</c:slot>
```

Inspiration
-----------

- https://v3.vuejs.org/guide/component-slots.html
- https://github.com/vuejs/rfcs/pull/182
- https://github.com/giuseppeg/xm
