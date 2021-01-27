<?php

function store($path = null, $value = null)
{
    static $store = null;
    
    if (!$store) {
        $store = new \App\Services\Store;
    }
    
    if (!$path) {
        return $store;
    }
    
    if (!$value) {
        return data_get($store, $path);
    }
    
    data_set($store, $path, $value);
    
    return $store;
}

if (!function_exists('get_localized_attribute')) {
    function get_localized_attribute($root, $attribute_name)
    {
        if (app()->getLocale() !== 'en' && $root->relevant_translation) {
            return $root->relevant_translation[$attribute_name];
        }
        
        return $root->getOriginal($attribute_name);
    }
}

if (!function_exists('asset_no_cache')) {
    function asset_no_cache($path, $secure = null)
    {
        $parsed_url = parse_url($path);
        $new_path = $parsed_url['path'];
        
        if (isset($parsed_url['query']) && $parsed_url['query']) {
            $new_path .= '?';
            $new_path .= $parsed_url['query'];
            $new_path .= '&' . time();
        } else {
            $new_path .= '?' . time();
        }
        
        return asset($new_path, $secure);
    }
}

if (!function_exists('custom_validation_messages')) {
    function custom_validation_messages($place_name)
    {
        $fallback_validation = __('validation', [], config('app.fallback_locale'));
        $custom_validation_messages = [];
        
        if (isset($fallback_validation['places']) && is_array($fallback_validation['places'])) {
            if (isset($fallback_validation['places'][$place_name])) {
                $custom_validation_messages = $fallback_validation['places'][$place_name];
            }
        }
        
        if (app()->getLocale() != config('app.fallback_locale')) {
            $current_validation = __('validation', [], app()->getLocale());
            
            if (isset($current_validation['places']) && is_array($current_validation['places'])) {
                if (isset($current_validation['places'][$place_name])) {
                    $custom_validation_messages = array_merge($custom_validation_messages, $current_validation['places'][$place_name]);
                }
            }
        }
        
        return $custom_validation_messages;
    }
}

if (!function_exists('get_next_period_date')) {
    function get_next_period_date($base_date, $previous_date, $period)
    {
        $some_day_of_next_date_month = (new \DateTime)->setDate($previous_date->format('Y'), $previous_date->format('m'), 1)->modify($period == 'year' ? '+1 year' : '+1 month');
        
        $next_date = (new \DateTime)->setDate($some_day_of_next_date_month->format('Y'), $some_day_of_next_date_month->format('m'), $base_date->format('d'));
        
        while ($next_date->format('m') != $some_day_of_next_date_month->format('m')) {
            $next_date = $next_date->modify('-1 day');
        }
        
        return $next_date;
    }
}

if (!function_exists('extract_fee_from_string')) {
    function extract_fee_from_string($string)
    {
        return [
            'percentage' => collect(explode('+', $string))->filter(function ($current_fee) {
                return $current_fee[strlen($current_fee) - 1] == '%';
            })->map(function ($current_fee) {
                return floatval($current_fee);
            })->sum(),
            
            'fixed' => collect(explode('+', $string))->filter(function ($current_fee) {
                return $current_fee[strlen($current_fee) - 1] != '%';
            })->map(function ($current_fee) {
                return floatval($current_fee);
            })->sum(),
        ];
    }
}

function realtime($event_name, $event_data = [])
{
    $curl = curl_init(config('realtime.url') . '/event/' . $event_name);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($event_data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1); // 1 second to wait the connection
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    
    if (!$response = json_decode($result)) {
        return null;
    }
    
    if (isset($response->error)) {
        // throw new \Exception($response->error);
        return null;
    }
    
    return (array) $response->data;
}

function gmp_base_convert($number, $from_base, $to_base)
{
    return gmp_strval(gmp_init($number, $from_base), $to_base);
}

function google_client($state)
{
    $googleClient = new \Google_Client;
    $googleClient->setApplicationName(config('app.name'));
    $googleClient->setAuthConfig(config('google-auth.web'));
    
    if ($state == 'login') {
        $googleClient->setAccessType('offline');
        $googleClient->setIncludeGrantedScopes(true);
        $googleClient->addScope('email');
        $googleClient->addScope('profile');
        $googleClient->addScope(\Google_Service_Calendar::CALENDAR);
        $googleClient->setPrompt('select_account consent');
        $googleClient->setRedirectUri(route('auth.google'));
        $googleClient->setState(base64_encode(json_encode(['action' => 'login', 'locale' => app()->getLocale()])));
    } elseif ($state == 'calendar') {
        $googleClient->setAccessType('offline');
        $googleClient->setIncludeGrantedScopes(true);
        $googleClient->addScope('email');
        $googleClient->addScope('profile');
        $googleClient->addScope(\Google_Service_Calendar::CALENDAR);
        $googleClient->setPrompt('select_account consent');
        $googleClient->setRedirectUri(route('auth.google'));
        $googleClient->setState(base64_encode(json_encode(['action' => 'calendar', 'locale' => app()->getLocale()])));
    }
    
    return $googleClient;
}

function validate($data, $rules, $extraRules = [], $messages = [])
{
    $extraRules = is_array($extraRules) ? $extraRules : [];
    $messages = is_array($messages) ? $messages : [];
    
    $rules = array_map(function ($rule) {
        if (is_array($rule)) {
            return $rule;
        }
        
        return array_map(function ($rule) {
            return trim($rule);
        }, explode('|', $rule));
    }, $rules);
    
    $rules = array_map(function ($rule) {
        return array_reduce($rule, function ($ruleParts, $rulePart) {
            return array_merge($ruleParts, is_string($rulePart) ? explode('|', $rulePart) : [$rulePart]);
        }, []);
    }, $rules);
    
    $basicRules = array_filter(array_map(function ($rule) {
        return array_filter($rule, function ($rulePart) {
            return !($rulePart instanceof Closure);
        });
    }, $rules), function ($rule) {
        return count($rule) > 0;
    });
    
    if (is_array($extraRules) && count($extraRules) > 0) {
        foreach ($extraRules as $ruleKey => $ruleParts) {
            if (!is_integer($ruleKey)) {
                continue;
            }
            
            $extraRules[$ruleParts] = [];
            unset($extraRules[$ruleKey]);
        }
        
        $extraRules = array_map(function ($rule) {
            if (is_array($rule)) {
                return $rule;
            }
            
            return array_map(function ($rule) {
                return trim($rule);
            }, explode('|', $rule));
        }, $extraRules);
        
        $extraRules = array_map(function ($rule) {
            return array_reduce($rule, function ($ruleParts, $rulePart) {
                return array_merge($ruleParts, is_string($rulePart) ? explode('|', $rulePart) : [$rulePart]);
            }, []);
        }, $extraRules);
        
        $basicRules = array_filter($basicRules, function ($ruleKey) use ($extraRules) {
            return isset($extraRules[$ruleKey]);
        }, ARRAY_FILTER_USE_KEY);
        
        $basicRules = array_merge_recursive(array_filter($extraRules, function ($ruleKey) use ($basicRules) {
            return isset($basicRules[$ruleKey]);
        }, ARRAY_FILTER_USE_KEY), $basicRules);
    }
    
    $nestedRules = array_filter(array_map(function ($rule) {
        return array_filter($rule, function ($rulePart) {
            return $rulePart instanceof Closure;
        });
    }, $rules), function ($rule) {
        return count($rule) > 0;
    });
    
    $validator = validator()->make($data, $basicRules, $messages);
    $validated = [];
    
    try {
        $validated = $validator->validate();
    } catch (\Illuminate\Validation\ValidationException $exception) {
    }
    
    $errors = $validator->errors()->toArray();
    
    if (isset($basicRules['*'])) {
        $errors = array_filter($errors, function ($errorKey) use ($data) {
            return array_key_exists($errorKey, $data);
        }, ARRAY_FILTER_USE_KEY);
    }
    
    foreach ($nestedRules as $nestedRuleKey => $nestedRuleParts) {
        if (isset($errors[$nestedRuleKey])) {
            continue;
        }
        
        $nestedExtraRules = array_filter($extraRules, function ($ruleKey) use ($nestedRuleKey) {
            return Str::startsWith($ruleKey, $nestedRuleKey . '.');
        }, ARRAY_FILTER_USE_KEY);
        
        foreach ($nestedExtraRules as $nestedExtraRuleKey => $nestedExtraRuleValue) {
            $nestedExtraRules[Str::after($nestedExtraRuleKey, $nestedRuleKey . '.')] = $nestedExtraRuleValue;
            unset($nestedExtraRules[$nestedExtraRuleKey]);
        }
        
        if ($nestedRuleKey == '*') {
            foreach ($data as $nestedDataKey => $nestedDataValue) {
                if (!is_array($nestedDataValue)) {
                    continue;
                }
                
                foreach ($nestedRuleParts as $nestedRulePart) {
                    try {
                        $nestedValidated = $nestedRulePart($nestedDataValue, $nestedExtraRules);
                        Arr::set($validated, $nestedDataKey, $nestedValidated);
                    } catch (\Illuminate\Validation\ValidationException $exception) {
                        foreach ($exception->validator->errors()->getMessages() as $nestedMessageKey => $nestedMessageValue) {
                            $errors[$nestedDataKey . '.' . $nestedMessageKey] = $nestedMessageValue;
                        }
                    }
                }
            }
            
            continue;
        }
        
        foreach ($nestedRuleParts as $nestedRulePart) {
            $nestedDataValue = Arr::get($data, $nestedRuleKey);
            
            if (!is_array($nestedDataValue)) {
                continue;
            }
            
            try {
                $nestedValidated = $nestedRulePart($nestedDataValue, $nestedExtraRules);
                Arr::set($validated, $nestedRuleKey, $nestedValidated);
            } catch (\Illuminate\Validation\ValidationException $exception) {
                foreach ($exception->validator->errors()->getMessages() as $nestedMessageKey => $nestedMessageValue) {
                    $errors[$nestedRuleKey . '.' . $nestedMessageKey] = $nestedMessageValue;
                }
            }
        }
    }
    
    if (count($errors) === 0) {
        return $validated;
    }
    
    $resultValidator = validator()->make([], []);
    ksort($errors);
    
    foreach ($errors as $errorKey => $errorMessages) {
        foreach ($errorMessages as $errorMessage) {
            $resultValidator->errors()->add($errorKey, $errorMessage);
        }
    }
    
    throw new \Illuminate\Validation\ValidationException($resultValidator);
}
