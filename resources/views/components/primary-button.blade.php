<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150']) }} style="background-color: #407200;" onmouseover="this.style.backgroundColor='#5ea700'" onmouseout="this.style.backgroundColor='#407200'">
    {{ $slot }}
</button>
