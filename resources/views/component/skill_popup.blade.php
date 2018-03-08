 <div class="modal-body">
         @foreach ($data->skill_by_parentid as $item)
        <div class="checkbox">
        <label>    
               <?php 
                     $skillArray = explode(',', $data->data_skill_id_checked);
                     if (in_array($item->skill_id, $skillArray)) {
                ?>
              <input type="checkbox" checked name="checkbox_skill[]" value="{{ $item->skill_id }}"> {{ $item->skill_title }}
              <?php  }else { ?>
                <input type="checkbox" name="checkbox_skill[]" value="{{ $item->skill_id }}"> {{ $item->skill_title }}
               <?php  }   ?>
        </label>
         </div>
     @endforeach

   
      </div>
      <div class="modal-footer">
    <button class="btn btn-success btn-done" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>



  </form>