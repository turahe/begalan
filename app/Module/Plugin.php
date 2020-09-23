<?php

// Initialize the filter globals.
require(dirname(__FILE__) . '/TeachifyHook.php');

/** @var TeachifyHook[] $teachify_filter */
global $teachify_filter, $teachify_actions, $teachify_current_filter;

if ($teachify_filter) {
    $teachify_filter = TeachifyHook::build_preinitialized_hooks($teachify_filter);
} else {
    $teachify_filter = [];
}

if (! isset($teachify_actions)) {
    $teachify_actions = [];
}

if (! isset($teachify_current_filter)) {
    $teachify_current_filter = [];
}

/**
 * @param $tag
 * @param $function_to_add
 * @param int $priority
 * @param int $accepted_args
 * @return bool
 */
if (! function_exists('add_filter')) {
    function add_filter($tag, $function_to_add, $priority = 10, $accepted_args = 1)
    {
        global $teachify_filter;
        if (!isset($teachify_filter[$tag])) {
            $teachify_filter[$tag] = new TeachifyHook();
        }
        $teachify_filter[$tag]->add_filter($tag, $function_to_add, $priority, $accepted_args);
        return true;
    }
}

/**
 * @param $tag
 * @param bool $function_to_check
 * @return bool|int
 */
if (! function_exists('has_filter')) {
    function has_filter($tag, $function_to_check = false)
    {
        global $teachify_filter;

        if (!isset($teachify_filter[$tag])) {
            return false;
        }

        return $teachify_filter[$tag]->has_filter($tag, $function_to_check);
    }
}
/**
 * @param $tag
 * @param $value
 * @return mixed
 */
if (! function_exists('apply_filters')) {
    function apply_filters($tag, $value)
    {
        global $teachify_filter, $teachify_current_filter;

        $args = func_get_args();

        // Do 'all' actions first.
        if (isset($teachify_filter['all'])) {
            $teachify_current_filter[] = $tag;
            _teachify_call_all_hook($args);
        }

        if (!isset($teachify_filter[$tag])) {
            if (isset($teachify_filter['all'])) {
                array_pop($teachify_current_filter);
            }
            return $value;
        }

        if (!isset($teachify_filter['all'])) {
            $teachify_current_filter[] = $tag;
        }

        // Don't pass the tag name to TeachifyHook.
        array_shift($args);

        $filtered = $teachify_filter[$tag]->apply_filters($value, $args);

        array_pop($teachify_current_filter);

        return $filtered;
    }
}
/**
 * @param $tag
 * @param $args
 * @return mixed
 */
if (! function_exists('apply_filters_ref_array')) {
    function apply_filters_ref_array($tag, $args)
    {
        global $teachify_filter, $teachify_current_filter;

        // Do 'all' actions first
        if (isset($teachify_filter['all'])) {
            $teachify_current_filter[] = $tag;
            $all_args = func_get_args();
            _teachify_call_all_hook($all_args);
        }

        if (!isset($teachify_filter[$tag])) {
            if (isset($teachify_filter['all'])) {
                array_pop($teachify_current_filter);
            }
            return $args[0];
        }

        if (!isset($teachify_filter['all'])) {
            $teachify_current_filter[] = $tag;
        }

        $filtered = $teachify_filter[$tag]->apply_filters($args[0], $args);

        array_pop($teachify_current_filter);

        return $filtered;
    }
}
/**
 * @param $tag
 * @param $function_to_remove
 * @param int $priority
 * @return bool
 */
if (! function_exists('remove_filter')) {
    function remove_filter($tag, $function_to_remove, $priority = 10)
    {
        global $teachify_filter;

        $r = false;
        if (isset($teachify_filter[$tag])) {
            $r = $teachify_filter[$tag]->remove_filter($tag, $function_to_remove, $priority);
            if (!$teachify_filter[$tag]->callbacks) {
                unset($teachify_filter[$tag]);
            }
        }

        return $r;
    }
}
/**
 * @param $tag
 * @param bool $priority
 * @return bool
 */
if (! function_exists('remove_all_filters')) {
    function remove_all_filters($tag, $priority = false)
    {
        global $teachify_filter;

        if (isset($teachify_filter[$tag])) {
            $teachify_filter[$tag]->remove_all_filters($priority);
            if (!$teachify_filter[$tag]->has_filters()) {
                unset($teachify_filter[$tag]);
            }
        }

        return true;
    }
}
/**
 * @return mixed
 */
if (! function_exists('current_filter')) {
    function current_filter()
    {
        global $teachify_current_filter;
        return end($teachify_current_filter);
    }
}
/**
 * @return string
 */
if (! function_exists('current_action')) {
    function current_action()
    {
        return current_filter();
    }
}
/**
 * @param null $filter
 * @return bool
 */
if (! function_exists('doing_filter')) {
    function doing_filter($filter = null)
    {
        global $teachify_current_filter;

        if (null === $filter) {
            return !empty($teachify_current_filter);
        }

        return in_array($filter, $teachify_current_filter);
    }
}
/**
 * @param null $action
 * @return bool
 */
if (! function_exists('doing_action')) {
    function doing_action($action = null)
    {
        return doing_filter($action);
    }
}
/**
 * @param $tag
 * @param $function_to_add
 * @param int $priority
 * @param int $accepted_args
 * @return true
 */
if (! function_exists('add_action')) {
    function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1)
    {
        return add_filter($tag, $function_to_add, $priority, $accepted_args);
    }
}
/**
 * @param $tag
 * @param mixed ...$arg
 */
if (! function_exists('do_action')) {
    function do_action($tag, ...$arg)
    {
        global $teachify_filter, $teachify_actions, $teachify_current_filter;

        if (!isset($teachify_actions[$tag])) {
            $teachify_actions[$tag] = 1;
        } else {
            ++$teachify_actions[$tag];
        }

        // Do 'all' actions first
        if (isset($teachify_filter['all'])) {
            $teachify_current_filter[] = $tag;
            $all_args = func_get_args();
            _teachify_call_all_hook($all_args);
        }

        if (!isset($teachify_filter[$tag])) {
            if (isset($teachify_filter['all'])) {
                array_pop($teachify_current_filter);
            }
            return;
        }

        if (!isset($teachify_filter['all'])) {
            $teachify_current_filter[] = $tag;
        }

        if (empty($arg)) {
            $arg[] = '';
        } elseif (is_array($arg[0]) && 1 === count($arg[0]) && isset($arg[0][0]) && is_object($arg[0][0])) {
            // Backward compatibility for PHP4-style passing of `array( &$this )` as action `$arg`.
            $arg[0] = $arg[0][0];
        }

        $teachify_filter[$tag]->do_action($arg);

        array_pop($teachify_current_filter);
    }
}
/**
 * @param $tag
 * @return int
 */
if (! function_exists('did_action')) {
    function did_action($tag)
    {
        global $teachify_actions;

        if (!isset($teachify_actions[$tag])) {
            return 0;
        }

        return $teachify_actions[$tag];
    }
}
/**
 * @param $tag
 * @param $args
 */
if (! function_exists('do_action_ref_array')) {
    function do_action_ref_array($tag, $args)
    {
        global $teachify_filter, $teachify_actions, $teachify_current_filter;

        if (!isset($teachify_actions[$tag])) {
            $teachify_actions[$tag] = 1;
        } else {
            ++$teachify_actions[$tag];
        }

        // Do 'all' actions first
        if (isset($teachify_filter['all'])) {
            $teachify_current_filter[] = $tag;
            $all_args = func_get_args();
            _teachify_call_all_hook($all_args);
        }

        if (!isset($teachify_filter[$tag])) {
            if (isset($teachify_filter['all'])) {
                array_pop($teachify_current_filter);
            }
            return;
        }

        if (!isset($teachify_filter['all'])) {
            $teachify_current_filter[] = $tag;
        }

        $teachify_filter[$tag]->do_action($args);

        array_pop($teachify_current_filter);
    }
}
/**
 * @param $tag
 * @param bool $function_to_check
 * @return false|int
 */
if (! function_exists('has_action')) {
    function has_action($tag, $function_to_check = false)
    {
        return has_filter($tag, $function_to_check);
    }
}
/**
 * @param $tag
 * @param $function_to_remove
 * @param int $priority
 * @return bool
 */
if (! function_exists('remove_action')) {
    function remove_action($tag, $function_to_remove, $priority = 10)
    {
        return remove_filter($tag, $function_to_remove, $priority);
    }
}
/**
 * @param $tag
 * @param bool $priority
 * @return true
 */
if (! function_exists('remove_all_actions')) {
    function remove_all_actions($tag, $priority = false)
    {
        return remove_all_filters($tag, $priority);
    }
}
/**
 * @param $args
 */
if (! function_exists('_teachify_call_all_hook')) {
    function _teachify_call_all_hook($args)
    {
        global $teachify_filter;

        $teachify_filter['all']->do_all_hook($args);
    }
}
if (! function_exists('_teachify_filter_build_unique_id')) {
    function _teachify_filter_build_unique_id($tag, $function, $priority)
    {
        global $teachify_filter;
        static $filter_id_count = 0;

        if (is_string($function)) {
            return $function;
        }

        if (is_object($function)) {
            // Closures are currently implemented as objects
            $function = [$function, ''];
        } else {
            $function = (array)$function;
        }

        if (is_object($function[0])) {
            // Object Class Calling
            return spl_object_hash($function[0]) . $function[1];
        }
        if (is_string($function[0])) {
            // Static Calling
            return $function[0] . '::' . $function[1];
        }
    }
}
