@props(['name'])
<div wire:ignore>
 
    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
    @endpush
   

    <input id="trix" type="hidden" value="{{ isset($attrbiutes['value']) ? $attrbiutes['value'] : ''}}" name={{$name}} maxlength="5000">
    
    <trix-editor input="trix" wire:model.debounce="''"></trix-editor>

  
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
    @endpush
  
  
    <style>
        .trix-button--icon-code {
            display: none;
            
        }
        .trix-button--icon-attach {
            display:none;
        }
        .trix-button--icon-link {
            display: none;
        }
        .trix-button--icon-heading-1 {
            display: none;
        }
        .trix-button--icon-quote {
            display: none
        }

        trix-editor ul { list-style-type: disc !important; margin-left: 1rem !important; }  
        trix-editor ol { list-style-type: decimal !important; margin-left: 1rem !important; }
    </style>
</div>