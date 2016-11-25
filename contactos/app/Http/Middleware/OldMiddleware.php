<?php

namespace App\Http\Middleware;

use Closure;
use App\Contact;
use Illuminate\Support\Facades\Auth;

class OldMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $contact=$request->route('contact');
        //$contact=contact::findOfFail($contactId);
        if($contact->group=='family'){

            return redirect()->route('contacts.index');
        }
        return $next($request);
    }
}
