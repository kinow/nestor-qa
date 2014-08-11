{% block content %}
<div class='row'>
    <div class='col-xs-12'>
        {{ Form.open({'route': 'projects.store', 'class': 'form-horizontal', 'role': 'form'}) }}
            {{ Form.hidden('project_statuses_id', 1) }}
            <div class="form-group">
                {{ Form.label('name', 'Name', {'class': 'col-xs-2 control-label'}) }}
                <div class="col-xs-10">
                    {{ Form.input('text', 'name', old.name, {'id':"name", 'class': "form-control"}) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form.label('description', 'Description', {'class': 'col-xs-2 control-label'}) }}
                <div class="col-xs-10">
                    {{ Form.textarea('description', old.description, {'id': "description", 'rows': "3", 'class': "form-control col-xs-12"}) }}
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10 col-xs-offset-2">
                    <label class='checkbox'>
                        {{ Form.checkbox('position', 'true', true) }} Position project?
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class='col-xs-10 col-xs-offset-2'>
                    {{ Form.submit('Add', {'class': "btn btn-primary"}) }}&nbsp; {{ HTML.link(URL.previous(), 'Cancel', {'class': 'btn'}) }}
                </div>
            </div>
        {{ Form.close() }}
    </div>
</div>
{% endblock %}
