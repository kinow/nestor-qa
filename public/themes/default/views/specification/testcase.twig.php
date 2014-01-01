<div>
<h4>Test Case &mdash; {{ node.display_name }}</h4>
<hr/>

{% if errors is defined and errors is not empty %}
<ul>
    {% for error in errors.all() %}
    <li>{{ error }}</li> {% endfor %}
</ul>
{% endif %}

<h5>Name</h5>
<p>{{ testcase.name }}</p>
<h5>Description</h5>
<p>{{ testcase.description }}</p>
<h5>Execution Type</h5>
<p>{{ testcase.execution_type_name }}</p>
<hr/>
{{ HTML.linkRoute('testcases.edit', 'Edit', [testcase.id], {'class': 'btn btn-primary'}) }}
<hr/>
</div>