@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/ideabox.css">
<link rel="stylesheet" href="../css/ideaboxAdmin.css"><link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
@endsection

@section ( 'content' )

<h3 id="page"> Boite à idées </h3>

<h4 id="pub"> Administration </h4>

<div id="wrapper">
  <table id="table_id" class="display">
      <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Auteur</th>
            <th>Selectionner</th>
          </tr>
      </thead>
      <tbody id="tbody">
      </tbody>
  </table>
</div>


<script type="text/javascript" src="../js/ideasAdmin.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

@endsection