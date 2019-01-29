@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="../css/accountAdmin.css"><link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
@endsection

@section ( 'content' )

<h3 id="page"> Roles Utilisateurs </h3>

<h4 id="pub"> Administration </h4>

<div id="wrapper">
  <table id="table_id" class="display dataTable no-footer">
      <thead id="thread">

      </thead>
      <tbody id="tbody">
      </tbody>
  </table>
</div>




<script src="../js/accountAdmin.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

@endsection