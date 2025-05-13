import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

export default function useToast() {
    const _toast = (text, options = {}) => {
        toast(text, {
            theme: 'auto',
            type: 'success',
            position: 'bottom-right',
            dangerouslyHTMLString: true,
            autoClose: 5000,
            ...options,
        });
    };

    return _toast;

}
