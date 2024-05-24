@push('styles')
    <style>
        /* Progressbar */
        .progressbar {
            position: relative;
            display: flex;
            justify-content: space-between;
            counter-reset: step;
            margin: 2rem 0 4rem;
        }

        .progressbar::before,
        .progress {
            content: "";
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            height: 4px;
            width: 100%;
            background-color: #dcdcdc;
            z-index: -1;
        }

        .progress {
            background-color: #2949c7d0;
            width: 0%;
            transition: 0.3s;
        }

        .progress-step::before {
            counter-increment: step;
            content: counter(step);
        }

        .progress-step::after {
            content: attr(data-title);
            position: absolute;
            top: calc(100% + 0.5rem);
            font-size: 0.85rem;
            color: #707070;
        }

        .progress-step-active {
            background-color: rgb(11, 78, 179);
            color: #f3f3f3;
        }

        /* Form */

        .form-step {
            display: none;
            transform-origin: top;
            animation: animate 0.5s;
        }

        .form-step-active {
            display: block;
        }


        @keyframes animate {
            from {
                transform: scale(1, 0);
                opacity: 0;
            }

            to {
                transform: scale(1, 1);
                opacity: 1;
            }
        }

        .circular-progress {
            position: relative;
            height: 86px;
            width: 86px;
            border-radius: 50%;
            display: grid;
            place-items: center;

        }

        .circular-progress:before {
            content: "";
            position: absolute;
            height: 80%;
            width: 80%;
            background-color: #ffffff;
            border-radius: 50%;
            z-index: 2;

        }

        .circular-progress::after {
            content: "";
            position: absolute;
            height: 90%;
            width: 90%;
            background-color: #f6f3f3;
            border-radius: 50%;
            z-index: 1;
        }

        .value-container {
            position: relative;
            font-weight: 700;
            font-size: 17px;
            color: #3050CD;
            z-index: 3;
        }

    </style>

@endpush
<x-admin-layout>
    <livewire:gigs.create access="admin" :id="$id" />
</x-admin-layout>

