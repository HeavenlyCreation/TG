const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

elixir(mix => {
    mix.webpack('main.js');
});