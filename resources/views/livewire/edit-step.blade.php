<div>
    <div class="flex justify-center">
        <h2>Steps</h2>
        <span wire:click="increment" class="fas fa-plus-circle cursor-pointer fa-lg text-blue-400 pt-1 pl-2"></span>
    </div>
    @foreach($steps as $key=>$step)
        <div class="flex justify-center mt-2" wire:key="{{empty($step['id'])?$step['wireId']:$step['id']}}">
            <input type="text" name="stepName[]" class="p-2 border rounded-lg" placeholder="{{'Step ' . ($loop->index+1)}}" value="{{empty($step['name'])?"":$step['name']}}"/>
            <input type="hidden" name="stepId[]" value="{{empty($step['id'])?"":$step['id']}}">
            <span wire:click="remove({{$key}})" class="fas fa-trash text-red-500 fa-lg py-4 px-3 cursor-pointer"></span>
        </div>
    @endforeach
</div>
