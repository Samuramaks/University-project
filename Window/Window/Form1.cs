using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Diagnostics;
using System.Threading;
using System.Runtime.InteropServices;
using HWND = System.IntPtr;//HWND - это "дескриптор окна". HWND - это, по существу, указатели (IntPtr) со значениями, которые делают их указывающими на данные структуры окна.


namespace Window
{
    public partial class Form1 : Form
    {
        Dictionary<int, HWND> widt;
        const int SW_SHOWNORMAL = 6;//Сворачивает окно  
        const int SW_MINIMIZE = 1;//разворачивает окно
        [DllImport("user32.dll")]
        static extern int SetWindowText(IntPtr hWnd, string text);
        [DllImport("user32.dll")]
        static extern bool IsIconic(IntPtr hWnd);
        [DllImport("user32.dll")]
        static extern bool ShowWindow(IntPtr hWnd, int nCmdShow);
        public Form1()
        {
            InitializeComponent();
            UpdateListBox();
        }
        public void UpdateListBox()
        {
            listBox1.Items.Clear();
            widt = new Dictionary<int, HWND>();
            int i = 0;
            foreach (KeyValuePair<IntPtr, string> window in OpenWindowGetter.GetOpenWindows())
            {
                IntPtr hand = window.Key;
                string title = window.Value;
                widt.Add(i, hand);

                listBox1.Items.Add($"{hand}: {title}");

                i++;
            }
        }
        private void listBox1_SelectedIndexChanged(object sender, EventArgs e)
        {
                HWND hand = new HWND();
                try
                {
                    hand = widt[listBox1.SelectedIndex];
                }
                catch { return; }
        }
        public void RenameWindow()
        {
            if (textBox1.Text == "" || textBox1.Text.StartsWith(" ")) { return; }
            HWND hand = new HWND();
            try
            {
                hand = widt[listBox1.SelectedIndex];
            }
            catch { return; }
            string txt = textBox1.Text;
            textBox1.Text = "";
            if (!IsIconic(hand))
            {
                ShowWindow(hand, SW_SHOWNORMAL);
            }
            else
            {
                ShowWindow(hand, SW_MINIMIZE);
            }
            SetWindowText(hand, txt);
            UpdateListBox();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            UpdateListBox();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            RenameWindow();
        }  
        private void textBox1_KeyDown(object sender, KeyEventArgs e)
        {
            if(e.KeyCode == Keys.Enter)
            {
                RenameWindow();
            }
        }
       
    }
    public static class OpenWindowGetter //получение списка всех открытых окон в Windows
    {
        public static IDictionary<HWND, string> GetOpenWindows()
        {
            HWND shellWindow = GetShellWindow();
            Dictionary<HWND, string> windows = new Dictionary<HWND, string>();

            EnumWindows(delegate (HWND hWnd, int lParam)
            {
                if (hWnd == shellWindow) return true;
                if (!IsWindowVisible(hWnd)) return true;

                int length = GetWindowTextLength(hWnd);
                if (length == 0) return true;

                StringBuilder builder = new StringBuilder(length);
                GetWindowText(hWnd, builder, length + 1);

                windows[hWnd] = builder.ToString();
                return true;

            }, 0);

            return windows;
        }

        private delegate bool EnumWindowsProc(HWND hWnd, int lParam);

        [DllImport("USER32.DLL")]
        private static extern bool EnumWindows(EnumWindowsProc enumFunc, int lParam);

        [DllImport("USER32.DLL")]
        private static extern int GetWindowText(HWND hWnd, StringBuilder lpString, int nMaxCount);

        [DllImport("USER32.DLL")]
        private static extern int GetWindowTextLength(HWND hWnd);

        [DllImport("USER32.DLL")]
        private static extern bool IsWindowVisible(HWND hWnd);

        [DllImport("USER32.DLL")]
        private static extern IntPtr GetShellWindow();
    }
}
