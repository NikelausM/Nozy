<head>
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 130%;
  padding-bottom: 12px;
  padding-left: 20px;
  padding-right: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: none;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.col-25 {
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row-1:after {
  content: "";
  display: table;
  clear: both;
}

</style>
</head>
<body>

  <h2>Make a post?</h2>
  <div class="container">
    <form action={{route('post.store')}} method="post">
      <div class="row-1">
        <div class="col-75" style="display: none;">
          <input type="number" id="post_profile_id" name="post_profile_id" value={{$profile->id}}>
        </div>
        <div class="col-75">
          <input type="text" id="subject" name="subject" placeholder="Subject">
        </div>
      </div>
      <div class="row-1">
        <div class="col-75">
          <textarea id="body" name="body" placeholder="Write something.." style="height:200px"></textarea>
        </div>
      </div>
      <div class="row-1">
        <input type="submit" value="Post">
        {{csrf_field()}}
      </div>
    </form>
  </div>

</body>
