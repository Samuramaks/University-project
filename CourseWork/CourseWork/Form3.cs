using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.IO;

namespace CourseWork
{
    public partial class Form3 : Form
    {
        string Changed;
        string[] file = File.ReadAllLines(@"D:\CourseWork\CourseWork\Продвинутый.txt");
        int count = 0;
        int plus = 0;
        int minus = 0;
        int kol = 1;
        int tk;
        int i = 60;
        int score;
        int chet = 0;
        public Form3()
        {
            InitializeComponent();
        }


        private void timer1_Tick(object sender, EventArgs e)
        {
            tk = --i;
            TimeSpan span = TimeSpan.FromMinutes(tk);
            string label = span.ToString(@"hh\:mm");
            label1.Text = label.ToString();
            score = i - tk;
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Changed = "01:00";
            label1.Text = Changed;
            timer1.Interval = 1000;
            timer1.Enabled = true;
            timer1.Start();
            label2.Text = file[count];
            textBox1.Text = "";
        }
        public void KeyInput(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Enter)
            {
                WorkChecker(textBox1.Text);
                count++;
                kol++;
                label2.Text = file[count];
                textBox1.Text = "";

                if (i < 0)
                {
                    timer1.Stop();
                    label6.Text = score.ToString();
                    WorkChecker(textBox1.Text);
                    textBox1.Text = "";
                    textBox1.Enabled = false;
                    button1.Enabled = false;
                    return;
                }
                else if (count >= file.Length - 1)
                {
                    timer1.Stop();
                    label6.Text = score.ToString();
                    WorkChecker(textBox1.Text);
                    textBox1.Text = "";
                    textBox1.Enabled = false;
                    button1.Enabled = false;
                    return;
                }
            }
        }
        public void WorkChecker(string Word)
        {
            if (Word == file[count])
            {
                plus++;
            }
            else
            {
                minus++;
            }
            label7.Text = $"{plus} из {kol}";
            label8.Text = $"{minus} из {kol}";
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Form1 f = new Form1();
            f.Show();
            this.Hide();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            Form f = new Form5();
            f.Show();
            this.Hide();
        }

        private void timer2_Tick(object sender, EventArgs e)
        {
            Chart.Right.Add(chet);
            chet = 0;
        }
    }
}
